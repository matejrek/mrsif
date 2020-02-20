<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = ['name', 'description','user_id'];

    public function sections(){
        return $this->hasMany('App\Section');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
