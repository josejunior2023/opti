<?php
namespace App\Models;

use Core\Database\ActiveRecord\Model;

class Login extends Model
{
  protected static string $table = 'logins';
  protected static array $columns = ['id', 'email', 'password'];



    // Propriedades
    public ?int $id = null;
    public ?int $user_id = null;
    public ?int $admin_id = null;
    public string $email;
    public string $password;

    public function validates(): void
    {
        // Adicione as validações conforme necessário
        if (empty($this->email)) {
            throw new \InvalidArgumentException("O campo 'email' é obrigatório.");
        }

        if (empty($this->password)) {
            throw new \InvalidArgumentException("O campo 'password' é obrigatório.");
        }
    }
}
