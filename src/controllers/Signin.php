<?php

namespace Ptorres\PhpMvcComposer\controllers;

use Exception;
use Ptorres\PhpMvcComposer\models\User;
use Ptorres\PhpMvcComposer\lib\Controller;

class Signin extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function auth()
    {
        try {
            $username = $this->post('username');
            $password = $this->post('password');

            if (
                is_null($username) ||
                is_null($password)
            ) {
                throw new Exception('ERROR - signin/auth: Fields requireds.');
            }

            if (!User::exists($username)) {
                throw new Exception('ERROR - signin/auth: User not found.');
            }

            $user = User::get($username);

            if (!$user->comparePassword($password)) {
                throw new Exception('ERROR - signin/auth: User credentials not valid.');
            }

            $_SESSION['user'] = serialize($user);
            header('location: /home');
        } catch (Exception $e) {
            error_log($e);
            header('location: /signin');
        }
    }
}
