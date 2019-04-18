<?php

namespace App\Api;

use App\Adapter\AdapterInterface;

abstract class AbstractApi{

	/**
	 * @var AdapterInterface
	 */
	protected $adapter;

	/**
	 * @var string
	 */
	protected $string;

	/**
	 * @var string
	 */
	protected $endpoint;

    public function __construct(AdapterInterface $adapter){
		$this->adapter = $adapter;
		$this->endpoint = 	getenv("EXPLORE_PROTOCOL") . 
		"://" .				getenv('RANCHER_API_HOST') . 
		'/' . 				getenv("RANCHER_API_VERSION") . 
		'/cluster/'	.		getenv('RANCHER_API_CLUSTER_ID');
	}

	public function setEndpoint($endpoint){
		$this->endpoint = $endpoint;
	}
}