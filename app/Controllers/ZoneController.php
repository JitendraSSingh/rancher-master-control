<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Cloudflare;

class ZoneController{

	private $cloudflare;
	
	public function __construct(Cloudflare $cloudflare){
		$this->cloudflare = $cloudflare;
	}

	public function getZoneId(Request $request, Response $response, $args){
		$name = $request->getQueryParam('name');
		try{
			$zoneId = $this->cloudflare->getZoneId($name);
		}catch(\Exception $e){
			return $response->withJson(['zone_id' => null], $e->getCode());
		}
		
		if ($zoneId) {
			return $response->withJson(['zone_id' => $zoneId]);
		}
		return $response->withJson(['zone_id' => null], 404);
	}
}