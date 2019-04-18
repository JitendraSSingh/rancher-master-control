<?php

namespace App\Entity;

class EmptyProperty{
	
	/**
	 * @var null
	 */
	public $serviceId = null;
	
	/**
	 * @var integer
	 */
	public $targetPort = 80;
	
	/**
	 * @var string
	 */
	public $type = "/v3/project/schemas/httpIngressPath";
	
	/**
	 * @var array
	 */
	public $workloadIds = [];
}