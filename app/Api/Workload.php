<?php

namespace App\Api;


class Workload extends AbstractApi{

	public function create($data){
		$this->setEndpoint(
						getenv("EXPLORE_PROTOCOL") . 
		"://" .			getenv('RANCHER_API_HOST') . 
		'/' . 			getenv("RANCHER_API_VERSION") . 
		'/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
		);
		return $this->adapter->post(sprintf("%s/workloads", $this->endpoint), $data);
	}

	public function get($queryParams){
		$name = $queryParams['name'];
		$namespaceId = $queryParams['namespaceid'];
		$this->setEndpoint(
						getenv("EXPLORE_PROTOCOL") . 
		"://" .			getenv('RANCHER_API_HOST') . 
		'/' . 			getenv("RANCHER_API_VERSION") . 
		'/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
		);
		return $this->adapter->get(sprintf("%s/workloads?namespaceId=%s&name=%s", $this->endpoint, $namespaceId, $name));
	}
}