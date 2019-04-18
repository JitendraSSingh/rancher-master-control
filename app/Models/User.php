<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

	protected $table = "oauth_users";

	protected $fillable = ['username', 'first_name', 'last_name', 'email'];

	public function setPassword($plainTextPassword){
		$hashedPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);
		$this->password = $hashedPassword;
	}

	public function setIsEmailVerfied($emailVerified = 0){
		$this->email_verified = $emailVerified;
	}

	public function verifyPassword($plainTextPassword){
		return password_verify($plainTextPassword, $this->password);
	}

}