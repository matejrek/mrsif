<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    //
    protected $fillable = [
        'masurment', 'unit_type',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function results(){
        return $this->hasMany(TrackerResult::class);
    }
}
