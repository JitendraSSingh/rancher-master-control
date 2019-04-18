<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Workload;

class Namespaces extends Model{

	protected $table = "namespaces";

	protected $primaryKey = 'name';

	public $incrementing = false;

	protected $fillable = ['cluster_id','project_id', 'url', 'user_id', 'email_address', 'user_name'];

	public function setName($name){
		$this->name = $name;
	}

	public function workloads(){
		return $this->hasMany(Workload::class);
	}

}