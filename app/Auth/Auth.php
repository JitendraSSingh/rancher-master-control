<?php

namespace App\Auth;

use App\Models\User;

use App\Handlers\AuthException;

use Psr\Http\Message\ServerRequestInterface as Request;

class Auth{

	public function user(){
		if(array_key_exists('user', $_SESSION)){
			return User::find($_SESSION['user']);	
		}
    }

	public function attempt(string $emailAddress,string $password, Request $request){
		$user = User::where('email', $emailAddress)->first();
		
		$error = "Could Not Signin with those details";

		if(!$user){
			throw new AuthException($request, $error);
		}

		if($user->verifyPassword($password)){
			$_SESSION['user'] = $user->id;
			return true;
		}

		throw new AuthException($request, $error);

		return false;
	}

	public function check(){
		return isset($_SESSION['user']);
	}

	public function logout(){
		unset($_SESSION['user']);
	}
}