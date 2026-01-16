<?php

namespace App\Controller;

use App\Core\Controller;
use App\Service\AuthService;

class DashboardController extends Controller
{
    public function dashboard()
    {
      
        $this->render('dashboard/user.html.twig');
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
