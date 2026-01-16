<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Core\Session;

class AuthService
{
    public function login(string $email , string $password)
    {
        $repo = new UserRepository();
        $user = $repo->findByUsername ($email );

        if (!$user || !($password==$user['password'])) {
            die('Identifiants incorrects');
        }
        Session::set('user', $user);
        header('Location: index.php?controller=dashboard&action=dashboard');
        exit;
    }
    public function register(string $username , string $password)
    {
        $repo = new UserRepository();
        $user = $repo->findByUsername ($username );

        if (!$user || !password_verify($password, $user['password'])) {
            die('Identifiants incorrects');
        }

        if ($user['status'] !== 'active') {
            die('Compte non activé');
        }

        Session::set('user', $user);
        header('Location: index.php?controller=dashboard&action=index');
        exit;
    }
}
