<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function PrintJob()
    {
        return $this->hasMany('App\PrintJob');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
