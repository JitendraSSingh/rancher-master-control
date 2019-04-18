<?php


use App\Controllers\NamespaceController;

use App\Controllers\WorkloadController;

use App\Controllers\LoadBalancerController;

use App\Controllers\ZoneController;

use App\Controllers\DnsController;

use App\Controllers\PersistentVolumeClaimController;

use App\Auth\Controllers\TokenController;

$app->post('/token', TokenController::class)->setName('token');

$app->group('', function(){
	
$this->post('/namespaces', NamespaceController::class . ':post');	

$this->get('/namespaces/{namespaceid}', NamespaceController::class . ':get');

$this->get('/namespaces', NamespaceController::class . ':list');

$this->post('/workloads', WorkloadController::class . ':post');

$this->get('/workloads', WorkloadController::class . ':get');	

$this->post('/persistentVolumeClaims', PersistentVolumeClaimController::class . ':post');

$this->get('/persistentVolumeClaims', PersistentVolumeClaimController::class . ':get');	

$this->post('/loadbalancers', LoadBalancerController::class . ':post');

$this->get('/loadbalancers/{namespaceid}/{name}', LoadBalancerController::class . ':get');

$this->get('/zones', ZoneController::class . ':getZoneId')->setName('get.zoneid');

$this->get('/zones/{zone_id}/dns_records', DnsController::class . ':list')->setName('list.dns');

$this->post('/dns', DnsController::class . ':post')->setName('post.dns');
	
})->add(App\Auth\GuardMiddleware::class);

