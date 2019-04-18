<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

//DOTENV

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');

$dotenv->load();

$settings = require __DIR__ . '/../settings.php';

$app = new \Slim\App($settings);

require __DIR__ . '/../dependencies.php';

require __DIR__ . '/../routes/web.php';

require __DIR__ . '/../routes/api.php';

$app->run();
