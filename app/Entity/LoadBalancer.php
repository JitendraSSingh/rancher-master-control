<?php

namespace App\Entity;

class LoadBalancer{

	/**
	 * @var Annotation
	 */
	public $annotations;

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
	public $projectId;

	/**
	 * @var Rule[]
	 */
	public $rules;

	/**
	 * @var string
	 */
	public $type;
}