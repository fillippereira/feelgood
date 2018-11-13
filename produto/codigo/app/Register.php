<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    
   
   
    public function humor(){
        return $this->belongsTo('App\Humor');
    }
    
    public function feeling(){
        return $this->hasManyThrough('App\Feeling', 'App\RegisterFeeling', 'register_id', 'id');
    }

    public function registerFeeling(){
        return $this->hasMany('App\RegisterFeeling');
    }

    public function registerThought(){
        return $this->hasMany('App\RegisterThought');
    }
}
