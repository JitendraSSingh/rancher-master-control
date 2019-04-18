<?php

namespace App\Auth\Controllers;

use Slim\Views\Twig as View;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use App\Models\User;

use Slim\Router;

class RegisterController{

	protected $view;

	protected $router;

	public function __construct(View $view, Router $router){
		$this->view = $view;
		$this->router = $router;
	}

	public function get(Request $request, Response $response){
		return $this->view->render($response, 'register.twig');
	}

	public function post(Request $request, Response $response){
		


		$parsedBody = $request->getParsedBody();
		//Todo Validation;
	
		$user = new User();

		$user->first_name = $parsedBody['first_name'];

		$user->last_name = $parsedBody['last_name'];

		$user->username = $parsedBody['user_name'];

		$user->email = $parsedBody['email'];

		$user->setPassword($parsedBody['password']);

		$user->setIsEmailVerfied(0);

		$user->save();

		return $response->withRedirect($this->router->pathFor('login'));
	}
}