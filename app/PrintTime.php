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
}
