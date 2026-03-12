<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\WaterModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $waterModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->waterModel = new WaterModel();


        helper('auth');
    }

    public function index() 
    {

        $data = [
            'title' => 'AUTH',
            'style' => 'auth',
            'javascript' => 'auth',
        ];

        echo view('includes/header', $data);
        echo view('auth/index');
        echo view('includes/footer', $data);

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

        if ($user && password_verify($password, $user['senha'])) {
            session()->set([
                'id'   => $user['id'],
                'name' => $user['nome'],
                'email' => $user['email'],
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
            'email'    => 'required|valid_email|is_unique[usuarios.email]', 
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
        $age = $this->request->getPost('age');
        $peso = $this->request->getPost('peso');
        $altura = $this->request->getPost('altura');

        // 4. Criptografando a senha (ISSO FAZ O LOGIN FUNCIONAR DEPOIS!)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 5. Salvando no banco de dados usando o Model
        $this->userModel->insert([
            'nome'     => $name,
            'email'    => $email,
            'senha' => $hashedPassword,
            'idade' => $age,
            'peso' => $peso,
            'altura' => $altura
        ]);

        $user = $this->userModel->findByEmail($email);

        session()->set([
            'id'   => $user['id'],
            'name' => $user['nome'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        // 6. Salvando no banco de dados o waterModel
        $this->waterModel->insert([
            'user_id' => $user['id'],
            'glasses' => 0,
            'log_date' => date('Y-m-d')
        ]);

        // 7. Tudo certo! Redireciona para o login com mensagem de sucesso
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