<?php

namespace App\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Rancher;
class PersistentVolumeClaimController{

    protected $rancher;
	
	public function __construct(Rancher $rancher){
		$this->rancher = $rancher;
	}

	public function list(Request $request, Response $response){
		
	}

	public function get(Request $request, Response $response){
		$queryParams = $request->getQueryParams();
		try{
			$apiResponse = $this->rancher->volume()->get($queryParams);	
		}catch(HttpException $e){		
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(200);
	}	

	public function post(Request $request, Response $response){
	try{
			$apiResponse = $this->rancher->volume()->create($request->getParsedBody());	
		}catch(\Exception $e){
			return $response->withHeader('Content-Type', 'application/json')->write($e->getMessage())->withStatus($e->getCode());
		}
		
		return $response->withHeader('Content-Type', 'application/json')->write($apiResponse)->withStatus(201);				
	}
}