<?php

use Ptorres\PhpMvcComposer\controllers\Signup;
use Ptorres\PhpMvcComposer\controllers\Signin;

$router = new \Bramus\Router\Router();

session_start();

$router->before('GET', '/', function () {
    $destination = isset($_SESSION['user']) ? '/home' : '/signin';
    header("location: $destination");
});

$router->get('/', function () {
    echo 'Wercome';
});

$router->get('/signin', function () {
    $controller = new Signin();
    $controller->render('signin/index');
});

$router->post('/auth', function () {
    $controller = new Signin();
    $controller->auth();
});

$router->get('/signup', function () {
    $controller = new Signup();
    $controller->render('signup/index');
});

$router->post('/register', function () {
    $controller = new Signup();
    $controller->register();
});

$router->get('/signout', function () {
    session_destroy();
    header('location: /');
});

$router->get('/home', function () {
    echo 'home';
});

$router->post('/publish', function () {
    echo 'publish';
});

$router->get('/profile', function () {
    echo 'profile';
});

$router->post('/addLike', function () {
    echo 'addLike';
});

$router->get('/singout', function () {
    echo 'singout';
});

$router->get('/profile/{username}', function ($username) {
    echo 'auth ' . $username;
});


$router->run();
