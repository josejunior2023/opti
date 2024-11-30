<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Core\Env\EnvLoader;
use Core\Errors\ErrorsHandler;
use Core\Router\Router;

ErrorsHandler::init();
EnvLoader::init();
Core\Router\Router::init();

require 'routes.php';

