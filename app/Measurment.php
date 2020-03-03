<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurment extends Model
{
    protected $fillable = [
        'value',
    ];

    public function tracker(){
        return $this->belongsTo(Tracker::class);
    }
}
