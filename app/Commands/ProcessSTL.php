<?php

namespace App\Commands;

use App\PrintJob;
use App\PrintTime;
use App\SlicerSetting;
use App\Slicer;

use App\Commands\Command;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProcessSTL extends Command implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $printjob, $slicersetting;

    /**
     * Create a new command instance.
     *
     * @param PrintJob $printjob
     * @param SlicerSetting $slicersetting
     * @internal param PrintJob $job
     * @internal param SlicerSetting $setting
     */
    public function __construct(PrintJob $printjob, SlicerSetting $slicersetting)
    {
        $this->printjob = $printjob;
        $this->slicersetting = $slicersetting;
    }

    /**
     * Execute the command.
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
            return;
        }

        $pos = strpos($result, "Filament");
        preg_match_all('!\d+!', $result, $matches, PREG_PATTERN_ORDER, $pos);
        $fillament = $matches[0][0];

        $result = shell_exec("/home/pbuchegger/GCodeAnalizer/gcode.py ".$full_gcode);
        preg_match_all('!\d+!', $result, $matches);
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
