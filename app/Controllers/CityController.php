<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class CityController extends Controller
{

	public function index($request, $response)
	{

		return $this->container->view->render($response, 'city.twig');
	}
}