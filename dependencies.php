<?php

use GuzzleHttp\Client;
use App\Auth\Controllers\LoginController;
use App\Auth\Controllers\LogoutController;
use App\Auth\Controllers\RegisterController;
use App\Auth\Controllers\CreateOAuthCredentialsController;
use App\Controllers\DashboardController;
use App\Controllers\NamespaceController;
use App\Controllers\WorkloadController;
use App\Controllers\LoadBalancerController;
use App\Controllers\ZoneController;
use App\Controllers\DnsController;
use App\Controllers\PersistentVolumeClaimController;

use App\Rancher;
use App\Adapter\GuzzleAdapter;
use App\Cloudflare;
use Cloudflare\API\Auth\APIKey as CloudflareAPIKey;
use Cloudflare\API\Adapter\Guzzle as CloudflareAdapter;
$container = $app->getContainer();

$container->register(new \App\Auth\OAuth2ServerProvider());



//PDO for OAuth2
$container['pdo'] = function($c){
	
	$db = $c['settings']['db'];

	$dbname = $db['database'];

	$dbhost = $db['host'];

	$user = $db['username'];

	$pass = $db['password'];

	$charset = $db['charset']; 

	$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=$charset";

	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	];

	return new PDO($dsn, $user, $pass, $opt);
};



$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();

$capsule->bootEloquent();


//Eloquent for App
$container['db'] = function($c){
	return $capsule;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__ .'/resources/views', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');

    $view->getEnvironment()->addGlobal('flash', $container['flash']);

     $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    $view->addExtension(new App\TwigExtension\CsrfExtension($container['csrf']));

    return $view;
};

$container['csrf'] = function($container){
	return new \Slim\Csrf\Guard();
};

$container['auth'] = function($container){
	return new \App\Auth\Auth();
};

$container['errorHandler'] = function($container){
	return new \App\Handlers\ErrorHandler($container['flash']);
};

$container['randomFactory'] = function($container){
	return new RandomLib\Factory; 
};

$container['guzzle'] = function($container){
	return new Client(
		[
			'base_uri' => getenv("EXPLORE_PROTOCOL") . '://' . getenv("RANCHER_API_HOST"),
			'headers' => [
				"Authorization" => "Bearer " . getenv("RANCHER_API_TOKEN")
			]
		]
	);
};

$container[GuzzleAdapter::class] = function($c){
    return new GuzzleAdapter($c->get('guzzle'));
};

$container[Rancher::class] = function($c){
	return new Rancher($c->get(GuzzleAdapter::class));
};

$container[CloudflareAPIKey::class] = function($c){
	return new CloudflareAPIKey(getenv('CLOUDFLARE_EMAIL'), getenv('CLOUDFLARE_API_KEY'));
};

$container[CloudflareAdapter::class] = function($c){
	return new CloudflareAdapter($c->get(CloudflareAPIKey::class));
};

$container[Cloudflare::class] = function($c){
	return new Cloudflare($c->get(CloudflareAdapter::class));
};

//$app->add($container['csrf']);

/*-------------------Controllers-------------------*/
$container[LoginController::class] = function($c){
	return new LoginController($c->get('auth'),$c->get('view'),$c->get('router'));
};

$container[LogoutController::class] = function($c){
	return new LogoutController($c->get('auth'),$c->get('router'));
};

$container[RegisterController::class] = function($c){
	return new RegisterController($c->get('view'), $c->get('router'));
};

$container[DashboardController::class] = function($c){
	return new DashboardController($c->get('view'), $c->get('router'));
};

$container[CreateOAuthCredentialsController::class] = function($c){
	return new CreateOAuthCredentialsController($c->get('router'),$c->get('view'),$c->get('randomFactory'), $c->get('flash'));
};

/*---------------------API CONTROLLERS---------------*/

$container[NamespaceController::class] = function($c){
	return new NamespaceController($c->get(Rancher::class));
};

$container[PersistentVolumeClaimController::class] = function($c){
	return new PersistentVolumeClaimController($c->get(Rancher::class));
};

$container[WorkloadController::class] = function($c){
	return new WorkloadController($c->get(Rancher::class));
};

$container[LoadBalancerController::class] = function($c){
	return new LoadBalancerController($c->get(Rancher::class));
};

$container[ZoneController::class] = function($c){
	return new ZoneController($c->get(Cloudflare::class));
};

$container[DnsController::class] = function($c){
	return new DnsController($c->get(Cloudflare::class));
};