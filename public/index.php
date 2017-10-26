<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new Slim\App();

require_once('../api/books.php');
require_once('../api/city.php');

$app->run();
