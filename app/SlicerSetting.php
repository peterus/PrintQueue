<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlicerSetting extends Model
{
    protected $fillable = ['name'];

    public function Slicer()
    {
        return $this->belongsTo('App\Slicer');
    }

    public function PrintTime()
    {
        return $this->hasMany('App\PrintTime');
    }
}
