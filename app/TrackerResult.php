<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackerResult extends Model
{
    protected $fillable = [
        'value',
    ];

    public function tracker(){
        return $this->belongsTo(Tracker::class);
    }
}
