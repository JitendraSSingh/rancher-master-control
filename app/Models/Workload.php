<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Namespaces;

class Workload extends Model{

	protected $fillable = ['workload_name'];	

	public function namespace(){
		return $this->belongsTo(Namespaces::class, 'foreign_key' ,'name'); 	
	}

}