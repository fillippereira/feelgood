<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterThought extends Model
{
    protected $table = 'register_thoughts';
    public function register(){
        return $this->belongsTo('App\Register','register_id');
    }

}
