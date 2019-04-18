<?php

return [
	'settings' => [
		'displayErrorDetails' => true,
		'addContentLengthHeader' => false,
		'db' => [
			'driver' 	=> 	getenv('DATABASE_DRIVER'),
			'host'		=>	getenv('DATABASE_HOST'),
			'database' 	=> 	getenv('DATABASE_NAME'),
			'username' 	=> 	getenv('DATABASE_USERNAME'),
			'password' 	=> 	getenv('DATABASE_PASSWORD'),
			'charset' 	=> 	getenv('DATABASE_CHARSET'),
			'collation' => 	getenv('DATABASE_COLLATION'),
			'prefix'	=>	getenv('DATABASE_PREFIX'),
		]
	]
];