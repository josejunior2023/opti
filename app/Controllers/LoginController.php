<?php

namespace App\Controllers;
use Core\Router\Route;
use Core\Router\Router;
class LoginController
{
    public function showLogin()
    {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
        include '../app/views/home/index.phtml';
    }

    public function logout()
{
    session_destroy();
    Router::redirect('/');
}

}
