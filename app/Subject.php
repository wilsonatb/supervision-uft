<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';

    // Relacion One to Many
    public function parameters (){
        return $this->hasMany('App\Parameter');
    }

    // Relación de Muchos a Uno
	public function school(){
		return $this->belongsTo('App\School');
	}

    // Relacion many to many
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();

         /* 
        // Listar usuarios de una materia
        $subject = App\Subject::findOrFail(1);

        return $subject->users; 

        // Listar materias de un usuario
        $user = App\User::findOrFail(2);

        return $user->subjects;
        */
    }

    // Relacion many to many
    public function sections()
    {
        return $this->belongsToMany('App\Section')->withTimestamps();

    }

   
}
