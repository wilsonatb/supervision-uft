<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }
}
