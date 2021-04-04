<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameter';

    // Relación de Muchos a Uno
	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

    // Relación de Muchos a Uno
	public function stage(){
		return $this->belongsTo('App\Stage', 'stage_id');
	}

    // Relación de Muchos a Uno
	public function lapse(){
		return $this->belongsTo('App\Lapse', 'lapse_id');
	}

    // Relación de Muchos a Uno
	public function subject(){
		return $this->belongsTo('App\Subject', 'subject_id');
	}

	public function section(){
		return $this->belongsTo('App\Section', 'section_id');
	}

	public function decan(){
		return $this->belongsTo('App\Decan', 'decan_id');
	}

	public function school(){
		return $this->belongsTo('App\School', 'school_id');
	}
}
