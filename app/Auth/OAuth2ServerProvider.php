<?php

namespace App\Auth;

use OAuth2;

use App\Auth\Controllers\TokenController;

use Pimple\Container;

use Pimple\ServiceProviderInterface;

class OAuth2ServerProvider implements ServiceProviderInterface{
	
	public function register(Container $container){

		$container[OAuth2\Server::class] = function ($c){

			$pdo = $c->get('pdo');
		
			$storage = new PdoStorage($pdo);

			$server = new OAuth2\Server($storage, ['access_lifetime' => 86400]);

			$server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

			return $server;
		};

		$container[TokenController::class] = function ($c){

			$server = $c->get(OAuth2\Server::class);
		
			return new TokenController($server);
		};
	
	
		$container[GuardMiddleware::class] = function($c){
			$server = $c->get(OAuth2\Server::class);
			return new GuardMiddleware($server);
		};
	}
	
}