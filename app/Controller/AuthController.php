<?php

namespace App\Controller;

use App\Core\Controller;
use App\Service\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new AuthService();
            $auth->login($_POST['email'], $_POST['password']);
        }

        $this->render('auth/login.html.twig');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new AuthService();
            $auth->login($_POST['email'], $_POST['password']);
        }

        $this->render('auth/login.html.twig');
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=auth&action=dashbord');
        exit;
    }
}
