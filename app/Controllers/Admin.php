<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\RecipeModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {

        $userModel = new UserModel();
        $receitasModel = new RecipeModel();
        $alimentosModel = new FoodModel();
        $data =
            [
                'totalUsuarios' => $userModel->countAllResults(),
                'ultimosUsuarios' => $userModel->orderBy('criado_em', 'DESC')->findAll(5),
                'totalReceitas' => $receitasModel->countAllResults(),
                'totalAlimentos' => $alimentosModel->countAllResults(),
            ];
        return view('admin/index', $data);
    }


    public function receitas()
    {
        $receitas = new RecipeModel();
        $data = [
            "receitas" => $receitas->orderBy('criado_em', 'DESC')->findAll(),
        ];

        return view('admin/alimentos/receita/index', $data);
    }

    public function usuarios()
    {
        $userModel = new UserModel();
        $data = [
            'usuarios' => $userModel->orderBy('criado_em', 'DESC')->findAll(),
        ];
        return view('admin/usuarios/index', $data);
    }

    // Rota usuarios/editar
    public function editarUsuario($id)
    {
        $userModel = new UserModel();
        $usuario = $userModel->find($id);

        if (!$usuario) {
            return redirect()->to('/admin/usuarios')->with('error', 'Usuário não encontrado.');
        }

        $data = [
            'usuario' => $usuario,
        ];

        return view('admin/usuarios/edit', $data);
    }
    
    public function atualizarUsuario($id)
    {
        $userModel = new UserModel();
        $usuario = $userModel->find($id);

        if (!$usuario) {
            return redirect()->to('/admin/usuarios')->with('error', 'Usuário não encontrado.');
        }

        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'idade' => $this->request->getPost('idade'),
            'altura' => $this->request->getPost('altura'),
            'peso' => $this->request->getPost('peso'),
        ];

        $userModel->update($id, $data);

        return redirect()->to('/admin/usuarios')->with('success', 'Usuário atualizado com sucesso.');
    }

}
