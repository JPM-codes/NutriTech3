<?php

namespace App\Controllers;

use App\Models\MetasModel;
use App\Models\UserModel;

class Profile extends BaseController
{

    protected $userId;
    protected $metasModel;

    public function __construct()
    {
        $this->userId = new UserModel();
        $this->metasModel = new MetasModel();
        helper('user');
    }

    public function index()
    {

        $usuario = $this->userId->findById(session('id'));
        $meta = $this->metasModel
            ->where('usuario_id', $usuario['id'])
            ->where('ativo', true)
            ->first();

        $data = [
            'title' => '',
            'style' => 'style',
            'style2' => 'profile',
            'javascript' => 'profile',
            'user' => $usuario,
            'meta' => $meta
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/profile.php');
        echo view('includes/footer', $data);
    }

    public function criar()
    {
        $user = $this->userId->findById(session('id'));
        $meta = $this->metasModel->insert([
            'usuario_id' => $user['id'],
            'meta_peso' => 0,
            'meta_calorias' => 2000,
            'nivel_atividade' => 1,
        ]);
    }

    public function atualizar()
    {
        $json = $this->request->getJSON();
        $userId = session('id');

        if (!$userId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Usuário não autenticado.'])->setStatusCode(401);
        }

        $meta = $this->metasModel
            ->where('usuario_id', $userId)
            ->where('ativo', true)
            ->first();

        if ($meta) {
            // 1. Cria o array dinâmico
            $dadosParaAtualizar = [];

            // 2. Verifica o que veio no JSON. 
            // Se a propriedade existir no JSON, nós preparamos para atualizar.
            if (isset($json->nivel)) {
                $dadosParaAtualizar['nivel_atividade'] = $json->nivel;
            }

            // Usamos isset() && $json->calorias !== "" para não salvar strings vazias
            if (isset($json->calorias) && $json->calorias !== "") {
                $dadosParaAtualizar['meta_calorias'] = $json->calorias;
            }

            if (isset($json->peso) && $json->peso !== "") {
                $dadosParaAtualizar['meta_peso'] = $json->peso;
            }

            // 3. Atualiza SOMENTE se tiver algo no array
            if (!empty($dadosParaAtualizar)) {
                $this->metasModel->update($meta['id'], $dadosParaAtualizar);
            }
        } else {
            // Se não existir meta nenhuma ainda, cria do zero
            $this->metasModel->insert([
                'usuario_id' => $userId,
                'nivel_atividade' => $json->nivel ?? 1,
                'meta_calorias' => !empty($json->calorias) ? $json->calorias : 2000,
                'meta_peso' => !empty($json->peso) ? $json->peso : 60,
                'ativo' => true
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Meta atualizada com sucesso!'
        ]);
    }

    public function atualizarPerfil()
    {
        // 1. Verifica se o usuário está logado
        $uid = session('id');
        if (!$uid) {
            return redirect()->to('/login')->with('error', 'Sessão expirada. Faça login novamente.');
        }

        // 2. Captura os dados enviados pelo formulário (via POST)
        $nome = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $pesoAtual = $this->request->getPost('currentWeight');
        $altura = $this->request->getPost('height');
        $idade = $this->request->getPost('age');

        $metaPeso = $this->request->getPost('targetWeight');

        // 3. Atualiza a tabela de Usuários
        $dadosUsuario = [
            'nome'   => $nome,
            'email'  => $email,
            'peso'   => $pesoAtual,
            'altura' => $altura,
            'idade'  => $idade
        ];

        // Substitua $this->userModel pelo nome real do seu model de usuários
        $this->userId->update($uid, $dadosUsuario);

        // 4. Atualiza a tabela de Metas (Apenas a meta de peso)
        $meta = $this->metasModel->where('usuario_id', $uid)->where('ativo', true)->first();

        if ($meta) {
            // Se já tem meta, atualiza
            $this->metasModel->update($meta['id'], [
                'meta_peso' => $metaPeso
            ]);
        } else {
            // Se não tem, cria uma nova (mantendo a lógica do upsert)
            $this->metasModel->insert([
                'usuario_id' => $uid,
                'meta_peso'  => $metaPeso,
                'ativo'      => true
            ]);
        }

        // 5. Redireciona de volta para a página de perfil com uma mensagem de sucesso
        return redirect()->to('/perfil');
    }
}
