<?php

namespace App\Entity;

class Rule{

	/**
	 * @var string
	 */
	public $host;

	/**
	 * @var Path
	 */
	public $paths;

	/**
	 * @var string
	 */
	public $type;
}