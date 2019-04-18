<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthClient extends Model{

	protected $primaryKey = 'client_id';

	public $incrementing = false;

	protected $table = "oauth_clients";

	protected $fillable = ['redirect_uri'];

	public function setUserId($userId){
		$this->user_id = $userId;
	}

	public function setClientId($clientId){
		
		$this->client_id = $clientId;
	}

	public function setClientSecret($clientSecret){
		
		$hashedClientSecret = password_hash($clientSecret, PASSWORD_DEFAULT);
		
		$this->client_secret = $hashedClientSecret;
	}

	public function setRedirectUri($redirectUri){

		$this->redirect_uri = $redirectUri;
	
	}

	public function setGrantTypes($grantTypes){
		
		$this->grant_types = $grantTypes;
	
	}

	public function setScope($scope){

		$this->scope = $scope;
	
	}


}