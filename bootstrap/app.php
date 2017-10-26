<?php

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__.'/../vendor/autoload.php';

// $user = new \App\Models\User;

// var_dump($user);

// die();

$app = new Slim\App([
		'settings' =>  [
			'displayErrorDetails'  =>  true,
		]
	]);



$container = $app->getContainer();

$container['view'] = function ($container){
	$view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
			'cache' => false // Update to true on prodction/ disable during development
		]);


	$view->addExtension(new \Slim\Views\TwigExtension(
			
			$container->router,

			$container->request->getUri()

		));

	return $view;
};


$container['HomeController'] = function ($container) {
	return new \App\Controllers\HomeController($container);
};

$container['CityController'] = function ($container) {
	return new \App\Controllers\CityController($container );
};

require __DIR__.'/../app/routes.php';


// require_once('../web/home.php');
// require_once('../api/books.php');
// require_once('../api/city.php');