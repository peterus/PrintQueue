<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintJob extends Model
{
    protected $fillable = ['name', 'quantity'];

    public function Project()
    {
        return $this->belongsTo('App\Project');
    }

    public function PrintTime()
    {
        return $this->hasMany('App\PrintTime');
    }
}
