<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Core\Session;
use App\Entity\User;

class AuthService
{
    public function login(string $email, string $password)
    {
        $repo = new UserRepository();
        $user = $repo->findByUsername($email);

        if (!$user || !($password == $user['password'])) {
            return false;
        }
        Session::set('user', $user);
        switch ($$user['role']) {
            case 'admin':
                header('Location: dashboardAdmin');
                break;
            case 'company':
                header('Location: dashboardComp');
                break;
            case 'condidat':
                header('Location: dashboarCond');
                break;
            
            default:
                echo "role indivand";
                break;
        }
        
        exit;
    }
    public function register($name, $email, $password, $passwordConfig, $role)
    {
        $repo = new UserRepository();
        $check = $repo->findByUsername($email);
        if ($check && $password != $passwordConfig) {
            return false;
        }
        $user = new User($name, $email, $password);
        $user->getRole()->setName($role);
        $insert = $repo->insert($user);
        if(!$insert){
            return false;
        }
        return true;
    }
}
