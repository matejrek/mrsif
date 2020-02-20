<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'description','routine_id'];


    public function exercises(){
        return $this->belongsToMany('App\Exercise');
    }

    public function routine(){
        return $this->belongsTo('App\Routine');
    }
}
