<?php

namespace App\Handlers;

use Exception;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

use Slim\Flash\Messages as Flash;

use ReflectionClass;

class ErrorHandler{

	protected $flash;

	public function __construct(Flash $flash){
		$this->flash = $flash;
	}

	public function __invoke(Request $request, Response $response, Exception $exception){
		$shortName = $this->getExceptionClassShortName($exception);
		if(method_exists($this, $handlerMethod = 'handle' . $shortName)){
			return $this->{$handlerMethod}($request, $response, $exception);
		}else{
			throw new \Exception($exception);
			
		}
		return $response;
	}

	public function getExceptionClassShortName($exception){
		return (new ReflectionClass($exception))->getShortName();
	}

	public function handleAuthException(Request $request, Response $response, Exception $exception){

		$this->flash->addMessage('error', $exception->getError());
		
		$this->flash->addMessage('oldInput', $request->getParsedBody());

		return $response->withRedirect($exception->getPath());
	}
}