<?php

namespace App\Middlewares;

use Slim\Flash\Messages as Flash;

use App\Auth\Auth;

use Slim\Router;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

class AuthMiddleware{

	protected $flash;

	protected $router;

	protected $auth;

	public function __construct(Auth $auth, Router $router, Flash $flash){
		
		$this->auth = $auth;
		
		$this->router = $router;
		
		$this->flash = $flash;
	}

	public function __invoke(Request $request, Response $response, callable $next){

		if(!$this->auth->check()){
			$this->flash->addMessage('error', 'Please Sign In before doing that');
			return $response->withRedirect($this->router->pathFor('login'));
		}

		$response = $next($request, $response);
		
		return $response;
	}
}