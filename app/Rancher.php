<?php

namespace App;

use App\Api\Workload;
use App\Api\Namespaces;
use App\Api\LoadBalancer;
use App\Api\PersistentVolumeClaim;
use App\Adapter\AdapterInterface;

class Rancher{

	/**
	 * @var AdapterInterface
	 */
	protected $adapter;

	/**
	 * @param AdapterInterface $adapter 
	 */
	public function __construct(AdapterInterface $adapter){
		$this->adapter = $adapter;
	}

	/**
	 * @return Workload
	 */
	public function workload(){
		return new Workload($this->adapter);
	}

	/**
	 * @return Namespaces
	 */
	public function namespace(){
		return new Namespaces($this->adapter);
	}

	/**
	 * @return LoadBalancer
	 */
	public function loadbalancer(){
		return new LoadBalancer($this->adapter);
	}

	/**
	 * @return PersistentVolumeClaim
	 */
	public function volume(){
		return new PersistentVolumeClaim($this->adapter);
	}
}