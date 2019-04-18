<?php

namespace App\Entity;

class Workload{

	/**
	 * @var array
	 */
	public $containers;

	/**
	 * @var DeploymentConfig
	 */
	public $deploymentConfig;

	/**
	 * @var string
	 */
	public $dnsPolicy = "ClusterFirst";

	/**
	 * @var boolean
	 */
	public $hostIPC = false;

	/**
	 * @var boolean
	 */
	public $hostNetwork = false;

	/**
	 * @var boolean
	 */
	public $hostPID = false;

	/**
	 * @var Label
	 */
	public $labels;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $namespaceId;

	/**
	 * @var string
	 */
	public $restartPolicy = "Always";

	/**
	 * @var integer
	 */
	public $scale = 1;

	/**
	 * @var string
	 */
	public $schedulerName = "default-scheduler";

	/**
	 * @var Selector
	 */
	public $selector;

	/**
	 * @var array
	 */
	public $volumes = [];

	/**
	 * @var WorkloadAnnotation
	 */
	public $workloadAnnotations;

	/**
	 * @var WorkloadLabel
	 */
	public $workloadLabels;

}