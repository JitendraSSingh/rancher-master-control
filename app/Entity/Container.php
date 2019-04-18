<?php

namespace App\Entity;

class Container{
	
	/**
	 * @var boolean
	 */
	public $allowPrivilegeEscalation = false;

	/**
	 * @var Environment
	 */
	public $environment;

	/**
	 * @var string
	 */
	public $image;

	/**
	 * @var string
	 */
	public $imagePullPolicy = "Always";

	/**
	 * @var boolean
	 */
	public $initContainer = false;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var boolean
	 */
	public $privileged = false;

	/**
	 * @var boolean
	 */
	public $readOnly = false;

	/**
	 * @var integer
	 */
	public $restartCount = 0;

	/**
	 * @var boolean
	 */
	public $runAsNonRoot = false;

	/**
	 * @var boolean
	 */
	public $stdin = true;

	/**
	 * @var boolean
	 */
	public $stdinOnce = false;

	/**
	 * @var string
	 */
	public $terminationMessagePath = "/dev/termination-log";

	/**
	 * @var string
	 */
	public $terminationMessagePolicy = "File";

	/**
	 * @var boolean
	 */
	public $tty = true;

	/**
	 * @var string
	 */
	public $type = "/v3/project/schemas/container";

	/**
	 * @var array
	 */
	public $volumeMounts;

}