<?php

namespace App\Auth;

use OAuth2\Server;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

class GuardMiddleware{

	/**
	 * @var \OAuth2\Server
	 */
	protected $oauth2server;

	public function __construct(Server $oauth2server){

		$this->oauth2server = $oauth2server;
	
	}

	public function __invoke(Request $request, Response $response, callable $next){

		$oauth2server = $this->oauth2server;
		$req = \OAuth2\Request::createFromGlobals();

		if(!$oauth2server->verifyResourceRequest($req)){
			
			$oauth2server->getResponse()->send();
			
			exit;
		}

		//store the username into the request's attributes
		$token = $oauth2server->getAccessTokenData($req);

		$request = $request->withAttribute('username', $token['user_id']);
		
		return $next($request, $response);
	}
}