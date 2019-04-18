<?php

namespace App\Entity;

class Volume{

	/**
	 * @var HostPath
	 */
	public $hostPath;

	/**
	 * @var string
	 */
	public $name = "vol1";

	/**
	 * @var string
	 */
	public $type = "/v3/project/schemas/volume";
}