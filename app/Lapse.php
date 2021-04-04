<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lapse extends Model
{
    protected $table = 'lapse';

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }

}
