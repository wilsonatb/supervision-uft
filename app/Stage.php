<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $table = 'stage';

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }
    
}
