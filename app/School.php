<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'school';

    // Relacion One to Many
    public function subjects (){
        return $this->hasMany('App\Subject');
    }

    public function decan(){
		return $this->belongsTo('App\Decan');
	}

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }
}
