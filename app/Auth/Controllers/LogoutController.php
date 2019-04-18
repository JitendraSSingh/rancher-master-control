<?php

namespace App\Auth\Controllers;

use Slim\Views\Twig as View;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use App\Auth\Auth;

use Slim\Router;

class LogoutController{

	protected $auth;

	protected $view;

	protected $router;

	public function __construct(Auth $auth, Router $router){
		
		$this->auth = $auth;
		
		$this->router = $router;
	}

	public function get(Request $request, Response $response){

		$this->auth->logout();

		return $response->withRedirect($this->router->pathFor('login'));
	}

}