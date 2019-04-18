<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use Slim\Router;

use Slim\Views\Twig as View;

class DashboardController{

	protected $view;

	protected $router;

	public function __construct(View $view, Router $router){
		$this->view = $view;
		$this->router = $router;
	}

	public function index(Request $request, Response $response){
		return $this->view->render($response, 'dashboard.twig');
	}

	public function websiteIndex(Request $request, Response $response){
			
	}
}