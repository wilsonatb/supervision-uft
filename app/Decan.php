<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decan extends Model
{
    protected $table = 'decan';

    // Relacion One to Many
    public function schools (){
        return $this->hasMany('App\School');
    }

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }
}
