<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    //
    protected $fillable = [
        'name', 'unit_type',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function results(){
        return $this->hasMany('App\TrackerResult');
    }
}
