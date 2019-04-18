<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Cloudflare;
use GuzzleHttp\Exception\ClientException;

class DnsController{

	private $cloudflare;
	
	public function __construct(Cloudflare $cloudflare){
		$this->cloudflare = $cloudflare;
	}

	public function list(Request $request, Response $response, $args){

		$zoneID = $args['zone_id'];
		$queryParams = $request->getQueryParams();
		$type = $queryParams['type'];
		$name = $queryParams['name'];
		
		$dns = $this->cloudflare->listRecords($zoneID, $type, $name);
		if ($dns->result_info->count < 1) {
			return $response->withJson(['records' => $dns], 404);
		}
		return $response->withJson(['records' => true]);
	}

	public function post(Request $request, Response $response){
		$body = $request->getParsedBody();
		$zoneID = $body['zone_id'];
		$type = $body['type'];
		$name = $body['name'];
		$content = $body['content'];
	
		try{
			$dns = $this->cloudflare->addRecord($zoneID, $type, $name, $content);
		}
		catch(ClientException $e){
			return $response->withJson(['records' => null], $e->getCode());
		}
		
		if (!$dns) {
			return $response->withJson(['records' => null], 409);
		}
		return $response->withJson(['records' => $dns], 201);
	}
}