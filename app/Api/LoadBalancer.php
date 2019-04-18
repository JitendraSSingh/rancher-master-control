<?php

namespace App\Api;

use App\Entity\Workload;

class LoadBalancer extends AbstractApi{

	public function create($data){
		$this->setEndpoint(
						getenv("EXPLORE_PROTOCOL") . 
		"://" .			getenv('RANCHER_API_HOST') . 
		'/' . 			getenv("RANCHER_API_VERSION") . 
		'/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
		);
		return $this->adapter->post(sprintf("%s/ingresses", $this->endpoint), $data);
	}

	public function get($namespaceId, $name){
		$this->setEndpoint(
						getenv("EXPLORE_PROTOCOL") . 
		"://" .			getenv('RANCHER_API_HOST') . 
		'/' . 			getenv("RANCHER_API_VERSION") . 
		'/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
		);
		return $this->adapter->get(sprintf("%s/ingresses/%s:%s", $this->endpoint, $namespaceId, $name));
	}
}