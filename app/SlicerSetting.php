<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlicerSetting extends Model
{
    protected $fillable = ['name'];

    public function Slicer()
    {
        return $this->belongsTo('Slicer');
    }
}
