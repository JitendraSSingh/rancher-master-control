<?php

namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Rancher;
class LoadBalancerController{

	protected $rancher;
	
	public function __construct(Rancher $rancher){
		$this->rancher = $rancher;
	}

	public function list(){

	}

	public function get(Request $request, Response $response, $args){
		$name = $args['name'];
		$namespaceId = $args['namespaceid'];
		try{
			$apiResponse = $this->rancher->loadbalancer()->get($namespaceId,$name);	
		}catch(\Exception $e){
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(200);
	}	

	public function post(Request $request, Response $response){
	try{
			$apiResponse = $this->rancher->loadbalancer()->create($request->getParsedBody());	
		}catch(\Exception $e){
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(201);				
	}
}