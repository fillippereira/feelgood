<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table ="registers";
    public function registerFeeling(){
        return $this->belongsToMany('App\RegisterFeeling');
    }
}
