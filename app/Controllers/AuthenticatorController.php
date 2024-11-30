<?php

namespace App\Controllers;

use App\Models\Login;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Core\Http\Response;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AuthenticatorController extends Controller
{

  public function showLogin()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
      include '../app/views/home/index.phtml';
  }
  public function authenticate(Request $request): void
  {
      $email = $request->input('email');
      $password = $request->input('password');

      $login = Login::first(['email' => $email]);

      // Verifica se o login existe e se a senha está correta
      if (!$login || password_verify($password, $login->password)) {
          FlashMessage::danger('Credenciais inválidas');
          $this->redirectTo('/'); // Redireciona para a página de login
          return;
      }

      // Caso seja administrador
      if ($login->admin_id) {
          $_SESSION['user_id'] = $login->id;
          $this->redirectTo('admin'); // Redireciona para o painel do administrador
      }


      if ($login->user_id) {
          $_SESSION['user_id'] = $login->id;
          $this->redirectTo('/user');
      }

      // Se chegar aqui, algo está errado (opcional)
      FlashMessage::danger('Erro inesperado. Entre em contato com o suporte.');
      $this->redirectTo('/');
  }

    // Método para logout
    public function logout(): void
    {
        Auth::logout();  // Chama o método logout de Auth
        FlashMessage::success('Você foi desconectado!');
        $this->redirectTo('/');
    }
    public function admin()
    {
        return view('admin');
    }
}
