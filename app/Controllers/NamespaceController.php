<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Rancher;
use App\Exceptions\HttpException;
class NamespaceController{

	protected $rancher;
	
	public function __construct(Rancher $rancher){
		$this->rancher = $rancher;
	}

	public function list(Request $request, Response $response){
		try {
			$apiResponse = $this->rancher->namespace()->list();
		} catch (HttpException $e) {
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(200);
	}

	public function get(Request $request, Response $response, $args){
		try{
			$apiResponse = $this->rancher->namespace()->get($args['namespaceid']);	
		}catch(HttpException $e){
			
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(200);
	}	

	public function post(Request $request, Response $response){
		try{
			$apiResponse = $this->rancher->namespace()->create($request->getParsedBody());	
		}catch(HttpException $e){
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(201);
	}

}