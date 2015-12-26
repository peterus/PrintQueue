<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintJob extends Model
{
    protected $fillable = ['name'];

    public function Project()
    {
        return $this->belongsTo('App\Project');
    }
}
