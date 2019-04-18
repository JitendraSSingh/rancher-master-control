<?php

namespace App\Entity;

class DeploymentConfig{

	/**
	 * @var integer
	 */
	public $maxSurge = 1;
	
	/**
	 * @var integer
	 */
	public $maxUnavailable = 0;
	
	/**
	 * @var integer
	 */
	public $minReadySeconds = 0;
	
	/**
	 * @var integer
	 */
	public $progressDeadlineSeconds = 600;
	
	/**
	 * @var integer
	 */
	public $revisionHistoryLimit = 10;
	
	/**
	 * @var string
	 */
	public $strategy = "RollingUpdate";
}