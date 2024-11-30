<?php

namespace Lib\Authentication;

use App\Models\Login;

class Auth
{
    public static function login(Login $login): void
    {
        if ($login->user_id) {
            $_SESSION['user']['id'] = $login->user_id;
        }
        if ($login->admin_id) {
            $_SESSION['admin']['id'] = $login->admin_id;
        }
    }

    public static function user()
    {
        if (isset($_SESSION['user']['id'])) {
            return User::findById($_SESSION['user']['id']);
        }
        return null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']['id']);
    }

    public static function logout(): void
    {
        unset($_SESSION['user']['id']);
        unset($_SESSION['admin']['id']);
    }
}
