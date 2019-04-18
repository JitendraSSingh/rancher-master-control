<?php

namespace App\Handlers;

use Exception;

use Psr\Http\Message\ServerRequestInterface as Request;


class AuthException extends Exception{

	private $request;

	public $error;
	
	public function __construct(Request $request, $error){
		$this->request = $request;
		$this->error = $error;
	}

	public function getPath(){
		return $this->request->getUri()->getPath();
	}

	public function getError(){
		return $this->error;
	}

}