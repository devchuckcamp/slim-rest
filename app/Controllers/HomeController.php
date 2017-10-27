<?php


namespace App\Controllers;

use Slim\Views\Twig as View;

use App\Models\User;

class HomeController extends Controller
{

	public function index($request, $response)
	{

		$city = $this->db->table('city')->get()->where('province',51);
		//$city->where('province',51);
		$user = User::find(1);

		return json_encode($user);

		//die();
		//return $this->container->view->render($response, 'home.twig');
	}

}