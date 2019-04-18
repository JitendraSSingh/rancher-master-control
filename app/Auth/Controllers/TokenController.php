<?php

namespace App\Auth\Controllers;

use OAuth2;

use OAuth2\Server;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

class TokenController{

	private $server;

	public function __construct(Server $server){

		$this->server = $server;
	
	}

	public function __invoke(Request $request, Response $response){

		$serverRequest = OAuth2\Request::createFromGlobals();
	
		$serverResponse = $this->server->handleTokenRequest($serverRequest);

		$response = $response->withStatus($serverResponse->getStatusCode());

		foreach ($serverResponse->getHttpHeaders() as $key => $value) {
			
			$response = $response->withHeader($key, $value);
		
		}

		$response = $response->withHeader('Content-Type', 'application/json');

		return $response->write($serverResponse->getResponseBody('json'));
	
	}
}