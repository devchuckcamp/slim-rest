<?php

namespace App\Auth;

use App\Models\User;

class Auth
{


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