<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

	public function user()
	{
		if(isset($_SESSION['user']) ){
			$_SESSION['user'] = $_SESSION['user'];
		}else{
			$_SESSION['user'] = '';
		}

		return User::find($_SESSION['user']);

	}

	public function checkAuth()
	{
		//session_unset($_SESSION['user']);
		// session_destroy();
		return isset($_SESSION['user']);

	}

	public function attempt($email, $password) {

		// grab user by email
		$user = User::where('email', $email)->first();
		// if user return false

		if ( !$user ) {
			return false;
		}

		// verfiy password for that user

		if( password_verify($password, $user->password) ) {

			//set info session
			$_SESSION['user'] = $user->id;

			return true;

		}

		return false;
		

	}

}
