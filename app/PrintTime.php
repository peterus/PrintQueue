<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintTime extends Model
{
    public function PrintJob()
    {
        return $this->belongsTo('App\PrintJob');
    }

    public function SlicerSetting()
    {
        return $this->belongsTo('App\SlicerSetting');
    }

    public function PrintTime()
    {
        $min = $this->time / 60;
        $h = $min / 60;
        return sprintf("%'.02d:%'.02d", floor($h), floor($min - 60*floor($h)));
    }
}
