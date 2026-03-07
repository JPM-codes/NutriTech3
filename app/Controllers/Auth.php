<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper('auth'); // se você tiver helpers de autenticação
    }

    public function index(): string {
        return view('auth/index');
    }

    public function login()
    {
        $rule = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rule)) {
            return view('auth/index', [
                'validation' => $this->validator
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['user_password'])) {
            session()->set([
                'user_id'   => $user['user_id'],
                'user_name' => $user['user_name'],
                'user_email' => $user['user_email'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Credenciais inválidas');
            return redirect()->to('/auth');
        }
    }

    public function register()
    {
        // 1. Regras de validação (os nomes precisam bater com os 'name' do seu formulário HTML)
        $rules = [
            'name'     => 'required|min_length[3]',
            // is_unique garante que ninguém crie duas contas com o mesmo email na tabela users
            'email'    => 'required|valid_email|is_unique[users.user_email]', 
            'password' => 'required|min_length[4]',
            'confirm'  => 'matches[password]' // Garante que a confirmação de senha é idêntica
        ];

        // 2. Se a validação falhar
        if (! $this->validate($rules)) {
            // Você pode capturar esses erros na view depois. Por enquanto, mandamos um erro genérico:
            session()->setFlashdata('error', 'Erro ao criar conta. Verifique os dados ou se o email já existe.');
            return redirect()->to('auth');
        }

        // 3. Pegando os dados do formulário
        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // 4. Criptografando a senha (ISSO FAZ O LOGIN FUNCIONAR DEPOIS!)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 5. Salvando no banco de dados usando o Model
        $this->userModel->insert([
            'user_name'     => $name,
            'user_email'    => $email,
            'user_password' => $hashedPassword
        ]);

        // 6. Tudo certo! Redireciona para o login com mensagem de sucesso
        session()->setFlashdata('success', 'Conta criada com sucesso! Agora você já pode entrar.');
        return redirect()->to('auth');
    }

    public function logout()
    {
        // 1. Destrói toda a sessão do usuário (apaga o id, nome, email e o status de logado)
        session()->destroy();

        // 2. Redireciona de volta para a tela de login (ajuste a rota se a sua for diferente)
        return redirect()->to('/auth'); 
    }
}