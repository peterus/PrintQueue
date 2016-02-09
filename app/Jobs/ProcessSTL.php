<?php

namespace App\Jobs;
use App\PrintJob;
use App\PrintTime;
use App\SlicerSetting;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mockery\CountValidator\Exception;

class ProcessSTL extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $printjob, $slicersetting;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PrintJob $printjob, SlicerSetting $slicersetting)
    {
        $this->printjob = $printjob;
        $this->slicersetting = $slicersetting;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stl = storage_path("app/".$this->printjob->file_name.$this->printjob->file_extension);
        $config = storage_path("app/".$this->slicersetting->file_name.$this->slicersetting->file_extension);
        $gcode = $this->printjob->file_name."-".$this->slicersetting->file_name.".gcode";
        $full_gcode = storage_path("app/".$gcode);

        // build command for commandline
        $command = $this->slicersetting->Slicer->command." ".$stl." --load ".$config." --output ".$full_gcode." 2>&1";

        // run command
        $result = shell_exec($command);

        // are there errors?
        $found = strpos($result, "Done.");
        if($found == false)
        {
            throw new Exception($command."\n".$result);
            return "Error!";
        }

        $pos = strpos($result, "Filament");
        preg_match_all('!\d+!', $result, $matches, PREG_PATTERN_ORDER, $pos);
        $fillament = $matches[0][0];

        $result = shell_exec("/srv/www/gcode.py ".$full_gcode);
        //print_r($result);
        preg_match_all('!\d+!', $result, $matches);
        //print_r($matches);
        $print_time = $matches[0][0];

        $printtime = PrintTime::where('print_job_id', '=', $this->printjob->id)->where('slicer_setting_id', '=', $this->slicersetting->id)->first();
        if($printtime == null)
        {
            $printtime = new PrintTime();
        }
        $printtime->print_job_id = $this->printjob->id;
        $printtime->slicer_setting_id = $this->slicersetting->id;
        $printtime->gcode = $gcode;
        $printtime->fillament = $fillament;
        $printtime->time = $print_time;
        $printtime->save();
    }
}
