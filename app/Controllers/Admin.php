<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\ReceitaIngredienteModel;
use App\Models\RecipeModel;
use App\Models\UnidadeModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    // Rota dashboard    
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

    // Rota receitas
    public function receitas()
    {
        $receitas = new RecipeModel();
        $data = [
            "receitas" => $receitas->orderBy('criado_em', 'DESC')->findAll(),
        ];

        return view('admin/alimentos/receita/index', $data);
    }
    public function editarReceita($id)
    {
        $receitaModel = new RecipeModel();
        $receitaIngredienteModel = new ReceitaIngredienteModel();
        $alimentosModel = new FoodModel();
        $unidadesModel = new UnidadeModel();
        $data = [
            'receita'=> $receitaModel->find($id),
            'todos_alimentos' => $alimentosModel->allFoods(),
            'ingredientes' => $receitaIngredienteModel->where('receita_id', $id)->findAll(),
            'todas_unidades' => $unidadesModel->findAll(),
        ];

        return view('admin/alimentos/receita/edit', $data);
    }
    public function criarReceita()
    {
        $alimentosModel = new FoodModel();
        $unidadesModel = new UnidadeModel();
        $data = [
            'todos_alimentos' => $alimentosModel->allFoods(),
            'todas_unidades' => $unidadesModel->findAll(),
        ];

        return view('admin/alimentos/receita/add', $data);
    }
    public function salvarReceita($id = null)
    {
        // 1. Instanciar os Models
        $receitaModel = new RecipeModel();
        $ingredienteModel = new ReceitaIngredienteModel();

        // 2. Pegar os dados básicos de texto
        $data = [
            'nome'          => $this->request->getPost('nome'),
            'descricao'     => $this->request->getPost('descricao'),
            'categoria'     => $this->request->getPost('categoria'),
            'dificuldade'   => $this->request->getPost('dificuldade'),
            'tempo_preparo' => $this->request->getPost('tempo_preparo'),
            'porcoes'       => $this->request->getPost('porcoes'),
        ];

        // 3. Lógica da Imagem
        $receitaAntiga = $id ? $receitaModel->find($id) : null;

        // A) O admin clicou em "Remover Foto"?
        if ($this->request->getPost('remover_imagem') == '1') {
            if ($receitaAntiga && $receitaAntiga['imagem']) {
                $caminhoFoto = FCPATH . 'assets/img/recipes/' . $receitaAntiga['imagem'];
                if (file_exists($caminhoFoto)) {
                    unlink($caminhoFoto); // Deleta o arquivo físico do servidor
                }
            }
            $data['imagem'] = null; // Atualiza o banco para ficar sem foto
        }

        // B) O admin enviou uma foto nova?
        $imagem = $this->request->getFile('imagem');
        if ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
            $nomeNovo = $imagem->getRandomName(); // Cria um nome aleatório e seguro
            $imagem->move(FCPATH . 'assets/img/recipes/', $nomeNovo); // Salva na pasta
            $data['imagem'] = $nomeNovo; // Adiciona o nome no array para salvar no banco

            // Se existia uma foto antiga e não foi deletada pelo botão de remover, apagamos agora para não lotar o servidor
            if ($receitaAntiga && $receitaAntiga['imagem'] && file_exists(FCPATH . 'assets/img/recipes/' . $receitaAntiga['imagem'])) {
                unlink(FCPATH . 'assets/img/recipes/' . $receitaAntiga['imagem']);
            }
        }

        // 4. Salvar a Receita (Insert ou Update)
        if ($id) {
            $data['id'] = $id;
            $receitaModel->save($data);
            $receita_id = $id;
        } else {
            $receita_id = $receitaModel->insert($data); // Se for nova, salva e pega o ID gerado
        }

        // 5. Lógica dos Ingredientes (O Pulo do Gato!)
        
        // Primeiro, deletamos todos os ingredientes antigos dessa receita para evitar duplicatas
        if ($id) {
            $ingredienteModel->where('receita_id', $receita_id)->delete();
        }

        // Agora, pegamos os arrays que vieram do formulário dinâmico
        $alimentos_ids = $this->request->getPost('alimento_id');
        $quantidades   = $this->request->getPost('quantidade');
        $unidades_ids  = $this->request->getPost('unidade_id');

        // Se o usuário enviou ingredientes, fazemos um loop para salvar um por um
        if (!empty($alimentos_ids)) {
            $ingredientesParaSalvar = [];
            
            for ($i = 0; $i < count($alimentos_ids); $i++) {
                // Previne de tentar salvar linhas vazias caso o usuário deixe um campo em branco
                if (!empty($alimentos_ids[$i]) && !empty($quantidades[$i])) {
                    $ingredientesParaSalvar[] = [
                        'receita_id'  => $receita_id,
                        'alimento_id' => $alimentos_ids[$i],
                        'quantidade'  => $quantidades[$i],
                        'unidade_id'  => $unidades_ids[$i]
                    ];
                }
            }

            // O insertBatch é uma função maravilhosa do CI4 que insere dezenas de linhas no banco com apenas uma requisição
            if (!empty($ingredientesParaSalvar)) {
                $ingredienteModel->insertBatch($ingredientesParaSalvar);
            }
        }

        // 6. Finalizar e redirecionar
        return redirect()->to(base_url('admin/receitas'))->with('success', 'Receita salva com sucesso!');
    }

    // Rota usuarios
    public function usuarios()
    {
        $userModel = new UserModel();
        $data = [
            'usuarios' => $userModel->orderBy('criado_em', 'DESC')->findAll(),
        ];
        return view('admin/usuarios/index', $data);
    }
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
