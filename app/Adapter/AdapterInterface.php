<?php

namespace App\Adapter;

interface AdapterInterface{
	
	/**
	 * @param  string $url
	 * @throws RequestException | ClientException
	 * @return string
	 */
	public function get($url);

	/**
	 * @param  string $url
	 * @throws RequestException | ClientException
	 * @return string
	 */
	public function delete($url);

	/**
	 * @param  string $url
	 * @param  array | string $content
	 * @throws RequestException | ClientException
	 * @return string
	 */
	public function put($url, $content = '');


	/**
	 * @param  string $url
	 * @param  array | string $content
	 * @throws RequestException | ClientException
	 * @return string
	 */
	
	public function post($url, $content = '');
}