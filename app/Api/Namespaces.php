<?php

namespace App\Api;


class Namespaces extends AbstractApi{

	public function create($data){
		return $this->adapter->post(sprintf("%s/namespaces", $this->endpoint), $data);
	}

	public function get($namespaceid){
		return $this->adapter->get(sprintf("%s/namespaces/%s", $this->endpoint, $namespaceid));
	}

	public function list(){
		$projectId = getenv("RANCHER_API_CLUSTER_ID") . ":" . getenv("RANCHER_API_PROJECT_ID");
		return $this->adapter->get(sprintf("%s/namespaces/?projectId=%s", $this->endpoint, $projectId));
	}
}