<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterFeeling extends Model
{
    protected $table = 'register_feelings';
    public function register(){
        return $this->belongsTo('App\Register','register_id');
    }

    public function feeling(){
        return $this->belongsTo('App\Feeling','feeling_id');
    }
}
