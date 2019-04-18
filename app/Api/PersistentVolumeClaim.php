<?php

namespace App\Api;


class PersistentVolumeClaim extends AbstractApi{

    public function create($data)
    {
		  $this->setEndpoint(
                      getenv("EXPLORE_PROTOCOL") . 
        "://" .		  	getenv('RANCHER_API_HOST') . 
        '/' . 			  getenv("RANCHER_API_VERSION") . 
        '/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
        );
        return $this->adapter->post(sprintf("%s/persistentVolumeClaims", $this->endpoint), $data);
	  }

    public function get($queryParams)
    {
      $name = $queryParams['name'];
      $namespaceId = $queryParams['namespaceId'];
      $this->setEndpoint(
                    getenv("EXPLORE_PROTOCOL") . 
      "://" .			  getenv('RANCHER_API_HOST') . 
      '/' . 			  getenv("RANCHER_API_VERSION") . 
      '/project/'	.	getenv('RANCHER_API_CLUSTER_ID') . ":" . getenv("RANCHER_API_PROJECT_ID")
      );
		  return $this->adapter->get(sprintf("%s/persistentVolumeClaims/?name=%s&namespaceId=%s", $this->endpoint, $name, $namespaceId));
	  }

}