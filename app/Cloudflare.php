<?php

namespace App;

use Cloudflare\API\Adapter\Guzzle as CloudflareAdapter;
use Cloudflare\API\Endpoints\Zones;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\EndpointException;

class Cloudflare{

	protected $adapter;
	
	public function __construct(CloudflareAdapter $adapter){
		$this->adapter = $adapter;
	}

	public function zones(){
		return new Zones($this->adapter);
	}

	public function dns(){
		return new DNS($this->adapter);
	}

	public function getZoneId(string $name = ''){
		try{
			$id = $this->zones()->getZoneId($name);
			return $id;
		}catch(EndpointException $ee){
			return false;
		}
		return false;
	}

	public function addRecord(
		string $zoneID, 
		string $type, 
		string $name,
		string $content,
        int $ttl = 0,
        bool $proxied = true,
        string $priority = ''){
		return $this->dns()->addRecord($zoneID, $type, $name, $content, $ttl, $proxied, $priority);
	}

	 public function listRecords(
        string $zoneID,
        string $type = '',
        string $name = '',
        string $content = '',
        int $page = 1,
        int $perPage = 20,
        string $order = '',
        string $direction = '',
        string $match = 'all'
    ){
	 	return $this->dns()->listRecords($zoneID, $type, $name, $content , $page, $perPage, $order, $direction, $match);
	 }
}