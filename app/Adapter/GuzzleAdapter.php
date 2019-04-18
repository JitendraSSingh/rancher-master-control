<?php

namespace App\Adapter;

use App\Exceptions\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class GuzzleAdapter implements AdapterInterface{

	protected $client;
	protected $response;
	
	public function __construct(Client $client, $token = null){
		$this->client = $client;
		$this->token = $token;
	}
	

	/**
	 * @return array
	 */
	public function getTokenHeaders(){
		return ['headers' => ['Authorization' => sprintf('Bearer %s', $this->token)]];
	}

	/**
     * {@inheritdoc}
     */

	public function get($url){
		try {
			$this->response = $this->client->get($url);
		} catch (RequestException $e) {
			$this->response = $e->getResponse();
			$this->handleError();
		} 
		return $this->response->getBody();
	}

	/**
     * {@inheritdoc}
     */
	public function delete($url){

	}

	/**
     * {@inheritdoc}
     */
	public function put($url, $content = ''){
		$options = [];
		$options[is_array($content) ? 'json' : 'body'] = $content;
		
		try {
			$this->response = $this->client->put($url, $options);
		}catch (RequestException $e) {
			$this->response = $e->getResponse();
			$this->handleError();
		}
		return $this->response->getBody();
	}


	/**
     * {@inheritdoc}
     */
	
	public function post($url, $content = ''){
		$options = [];
		$options[is_array($content) ? 'json' : 'body'] = $content;
		$options['http_errors'] = true;
		try {
			$this->response = $this->client->post($url, $options);
		} catch (RequestException $e) {
			$this->response = $e->getResponse();
			$this->handleError();
		}
		return $this->response->getBody();
	}

	public function handleError(){
		
		$body = (string)$this->response->getBody();
		
		$code = (int)$this->response->getStatusCode();
		
		throw new HttpException( (string)$this->response->getBody(), $code);
	}
}