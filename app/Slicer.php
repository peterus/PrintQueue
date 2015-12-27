<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slicer extends Model
{
    protected $fillable = ['name', 'command'];

    public function Setting()
    {
        return $this->hasMany('App\SlicerSetting');
    }
}
