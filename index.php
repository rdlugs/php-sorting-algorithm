<?php

define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BASE_URL', $_SERVER['SERVER_NAME']);
define('BASE_DIR', __DIR__);
define('PUBLIC_URL', BASE_DIR . '/public/');
define('HOST_URL', $_SERVER['HTTP_HOST']);

require_once BASE_DIR . '/Core/autoload.php';

$router = new Core\Router;
require_once BASE_DIR . '/routes/web.php';

$router->render();
