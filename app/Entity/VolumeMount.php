<?php

namespace App\Entity;

class VolumeMount{

	/**
	 * @var string
	 */
	public $mountPath = "/var/www/html";

	/**
	 * @var string
	 */
	public $name = "vol1";

	/**
	 * @var boolean
	 */
	public $readOnly = false;

	/**
	 * @var string
	 */
	public $type = "/v3/project/schemas/volumeMount"; 
}