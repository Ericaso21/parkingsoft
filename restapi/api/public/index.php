<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../../backend/helpers/helpers.php';
require '../../backend/config/config.php';
require '../../backend/libraries/core/conexion.php';
require '../../backend/libraries/core/mysql.php';

$app = new \Slim\App;

//rutas
require '../src/rutas/roles.php';

$app->run();