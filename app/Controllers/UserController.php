<?php


namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{

	public function index($request, $response)
	{

		$user = User::get();

		return json_encode($user);
	}


	public function get($request, $response, $args)
	{	
		$id = $args['id'];
		//$id = $request->getParam('id');

		$user = User::find($id);
		//$user = User::where('email','ch@gmail.com');
		return $response->withStatus(200)->getBody()->write($user->toJson());
	}

	public function save($request, $response, $args){

		$user = $request->getParams();
		
		$create = User::Create($user);
		
		return $response->withStatus(200)->getBody()->write($create->toJson());
	}

	public function update($request, $response, $args){

	}

	public function delete($request, $response, $args){

	}

}