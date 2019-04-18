<?php

use App\Middlewares\AuthMiddleware;

use App\Auth\Controllers\LoginController;

use App\Auth\Controllers\LogoutController;

use App\Auth\Controllers\RegisterController;

use App\Auth\Controllers\CreateOAuthCredentialsController;

use App\Controllers\DashboardController;

$app->get('/', LoginController::class . ':get')->setName('login');

$app->post('/', LoginController::class . ':post');

$app->group('', function(){

	$this->get('/logout', LogoutController::class . ':get')->setName('logout');

	$this->get('/dashboard', DashboardController::class . ':index')->setName('dashboard');

	$this->get('/admin/create-credentials', CreateOAuthCredentialsController::class . ':generate')->setName('admin.createcredentials');

	$this->get('/admin/show-credentials', CreateOAuthCredentialsController::class . ':show')->setName('aouthcreds.show');

})->add(new AuthMiddleware($container['auth'], $container['router'], $container['flash']));

//$app->get('/register', RegisterController::class . ':get')->setName('register');
//$app->post('/register', RegisterController::class . ':post');
