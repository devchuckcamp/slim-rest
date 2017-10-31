<?php

//============ Web ==============//

//Signup
$app->get('/', 'HomeController:index')->setName('home');

$app->get('/auth/signup', 'AuthController:getSignup')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignup');

//Signin
$app->get('/auth/signin', 'AuthController:getSignin')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignin');

//============API=================//
$app->get('/city', 'CityController:index');

//User
$app->get('/api/user/me', 'UserController:index');
$app->get('/api/user/{id}', 'UserController:get');
$app->get('/api/users', 'UserController:get');

$app->post('/api/users', 'UserController:save');


//Patient
$app->get('/api/patients', 'UserController:index');
