<?php

namespace App\Auth\Controllers;

use Slim\Views\Twig as View;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use App\Auth\Auth;

use Slim\Router;

use App\Models\User;

use App\Models\OAuthClient;

use RandomLib\Factory;

use Slim\Flash\Messages as Flash;

class CreateOAuthCredentialsController{

	protected $view;

	protected $router;

	protected $randomFactory;

	protected $flash;

	public function __construct(Router $router, View $view, Factory $randomFactory, Flash $flash){
		
		$this->router = $router;

		$this->view = $view;
		
		$this->randomFactory = $randomFactory;
	
		$this->flash = $flash;
	}

	public function show(Request $request, Response $response){

		$currentUrl = $request->getUri()->getPath();
		
		$this->view->render($response,'create_oauth_cred.twig', compact('currentUrl'));
	}

	public function generate(Request $request, Response $response){
		
		$clientId = $this->randomFactory->getLowStrengthGenerator()->generateString(12);

		$clientSecret = $this->randomFactory->getMediumStrengthGenerator()->generateString(32);
	
		$user = User::find($_SESSION['user']);

		if($user){

			$oauthClient = OAuthClient::where('user_id', $user->username)->first();
			
			//Check if the OAuth Client Already Exsist then Update or create New
			if($oauthClient){
				//Update Here
				$clientId = $oauthClient->client_id;

				$this->createOrUpdate($oauthClient, $clientId, $user, $clientSecret);

			}else{

				//Create Here
				$oauthClient = new OAuthClient;	
				
				$this->createOrUpdate($oauthClient, $clientId, $user, $clientSecret);
			}

			$this->flash->addMessage('clientOAuthCreds', compact('clientId','clientSecret'));

			return $response->withRedirect($this->router->pathFor('aouthcreds.show'));

		}

	}

	public function createOrUpdate($oauthClient, $clientId, $user, $clientSecret){
		
		$oauthClient->setClientId($clientId);

		$oauthClient->setUserId($user->username);

		$oauthClient->setClientSecret($clientSecret);

		$oauthClient->save();
	
	}

}