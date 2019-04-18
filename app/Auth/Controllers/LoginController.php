<?php

namespace App\Auth\Controllers;

use Slim\Views\Twig as View;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use App\Auth\Auth;

use Slim\Router;

use App\Handlers\AuthException;

class LoginController{

	protected $auth;

	protected $view;

	protected $router;

	public function __construct(Auth $auth, View $view, Router $router){
		
		$this->auth = $auth;

		$this->view = $view;
		
		$this->router = $router;
	}

	public function get(Request $request, Response $response){

		return $this->view->render($response, 'login.twig');
	}

	public function post(Request $request, Response $response){

		if($this->auth->attempt($request->getParam('email'), $request->getParam('password'), $request)){

			return $response->withRedirect($this->router->pathFor('dashboard'));
		}
		
	}
}