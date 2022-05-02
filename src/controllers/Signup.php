<?php

namespace Ptorres\PhpMvcComposer\controllers;

use Ptorres\PhpMvcComposer\models\User;
use Ptorres\PhpMvcComposer\lib\UtilImage;
use Ptorres\PhpMvcComposer\lib\Controller;

class Signup extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if (
            is_null($username) ||
            is_null($password) ||
            is_null($profile)
        ) {
            error_log("------- $username empty");
            return false;
        }

        $user = new User($username, $password);
        $user->setProfile(UtilImage::storeImage($profile));
        $user->save();

        header('location: /signin');
    }
}
