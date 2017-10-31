<?php

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Respect\Validation\Validator as v;

require __DIR__.'/../vendor/autoload.php';

// $user = new \App\Models\User;

// var_dump($user);

// die();

$app = new Slim\App([
		'settings' =>  [
			'displayErrorDetails'  =>  true,
			'db' => [
				'driver'=>'mysql',
				'host' => 'localhost',
				'database' =>  'slim_demo',
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'  =>  '',
			]
		],
		
	]);



$container = $app->getContainer();

// Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule) {
	return $capsule;
};


//Validator
$container['validator'] = function($container) {

	return new \App\Validation\Validator;

};

$container['csrf'] = function($container) {

	return new \Slim\Csrf\Guard;

};

$container['auth'] = function($container) {

	return new \App\Auth\Auth;

};


//View
$container['view'] = function ($container){
	$view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
			'cache' => false // Update to true on prodction/ disable during development
		]);


	$view->addExtension(new \Slim\Views\TwigExtension(
			
			$container->router,

			$container->request->getUri()

		));

	$view->getEnvironment()->addGlobal('auth', [
			'checkAuth' => $container->auth->checkAuth(),
			'user' =>  $container->auth->user(),
		]);
	return $view;
};



//Middleware
//Displaying Errors
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container) ); 
//Keeping Data in Forms
$app->add(new \App\Middleware\OldInputMiddleware($container) ); 
//Csrf View
$app->add(new \App\Middleware\CsrfViewMiddleware($container) ); 


//Custom Validator
v::with('App\\Validation\\Rules\\');
//CSRF
$app->add($container->csrf);



$container['HomeController'] = function ($container) {
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
	return new \App\Controllers\Auth\AuthController($container);
};

$container['CityController'] = function ($container) {
	return new \App\Controllers\CityController($container );
};

$container['UserController'] = function ($container) {
	return new \App\Controllers\UserController($container );
};


require __DIR__.'/../app/routes.php';


// require_once('../web/home.php');
// require_once('../api/books.php');
// require_once('../api/city.php');