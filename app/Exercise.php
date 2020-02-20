<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name', 'description', 'duration', 'duration_unit'];

    public function sections(){
        return $this->belongsToMany('App\Section');
    }
}
