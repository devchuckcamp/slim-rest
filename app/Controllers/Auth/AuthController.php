<?php


namespace App\Controllers\Auth;

use App\Models\User;

use App\Controllers\Controller;

use Respect\Validation\Validator as v;

class AuthController extends Controller
{

	public function getSignin($request, $response)
	{

		return $this->view->render($response, 'auth/signin.twig');

	}

	public function postSignin($request, $response)
	{

		$auth = $this->auth->attempt(

				$request->getParam('email'),
				$request->getParam('password')
			
			);

		if( !$auth) {

			return $response->withRedirect($this->router->pathFor('auth.signin') );

		}

		return $response->withRedirect($this->router->pathFor('home') );
			
	}

	public function getSignup($request, $response){

		// var_dump($this->csrf->getTokenNameKey());
		// var_dump($this->csrf->getTokenValueKey());
		// $nameKey = $this->csrf->getTokenNameKey();
  //   	$valueKey = $this->csrf->getTokenValueKey();
  //   	$name = $request->getAttribute($nameKey);
  //   	$value = $request->getAttribute($valueKey);

		// var_dump($request->getAttribute('csrf_value'));

		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignup($request, $response){

		// $user = $request->getParams();
		
		$validation = $this->validator->validate(
				$request , [

					'username' => v::noWhitespace()->notEmpty(),
					'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
					'password' => v::noWhitespace()->notEmpty(),
					'firstname' => v::notEmpty()->alpha(),
					'lastname' => v::notEmpty()->alpha()

				]

			);	

		if( $validation->failed() ) {

			return $response->withRedirect($this->router->pathFor('auth.signup') );

		}

		$user = User::Create([
				'username' => $request->getParam('username'),
				'firstname' => $request->getParam('firstname'),
				'lastname' => $request->getParam('lastname'),
				'email' => $request->getParam('email'),
				'password' =>password_hash($request->getParam('password'),
					PASSWORD_DEFAULT)
			]);
			
		$this->auth->attempt($user->email, $request->getParam('password'));

			return $response->withRedirect($this->router->pathFor('auth.signup') );
		// return $response->withStatus(200)->getBody()->write($create->toJson());
	}

}