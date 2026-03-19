<?php

namespace App\Controllers;

use App\Models\ReceitaIngredienteModel;
use App\Models\RecipeModel;
use App\Models\RefeicoesUserModel;
    
class Receitas extends BaseController
{

    protected $receitaIngredientesModel;
    protected $recipeModel;
    protected $refeicoesUser;

    public function __construct()
    {
        $this->receitaIngredientesModel = new ReceitaIngredienteModel();
        $this->recipeModel = new RecipeModel();
        $this->refeicoesUser = new RefeicoesUserModel();

        helper('auth'); // se você tiver helpers de autenticação
        helper('nutrition');
        helper('macro');
        helper('meal');
    }


    public function index()
    {
        $data = [
            'title' => '',
            'style' => 'style',
            'style2' => 'recipes',
            'javascript' => 'recipes',
            'recipes' => $this->recipeModel->getReceitasComMacros(),
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('receitas/recipes', $data);
        echo view('includes/footer', $data);
    }

    public function detalhes($id)
    {
        $receita = $this->recipeModel->getReceitaComMacros($id);

        if (!$receita) {
            return $this->response->setStatusCode(404)->setJSON(['erro' => 'Receita não encontrada']);
        }

        $ingredientes = $this->receitaIngredientesModel->getIngredientesDaReceita($id);

        $receita['lista_ingredientes'] = $ingredientes;

        return $this->response->setJSON($receita);
    }

    public function filtrarReceitas()
    {
        $categoria = $this->request->getGet('categoria') ?? 'all';
        $busca = $this->request->getGet('busca') ?? '';

        $recipes = $this->recipeModel->getReceitasFiltradas($categoria, $busca);

        return view('includes/card_receitas', ['recipes' => $recipes]);
    }

    public function adicionar()
    {
        // 1. Pega os dados enviados pelo fetch/AJAX
        $json = $this->request->getJSON();

        // 2. Prepara os dados para a tabela da imagem
        $data = [
            'usuario_id'     => session('id'), // Ou session()->get('user_id')
            'receita_id'     => $json->receita_id,
            'tipo_refeicao'  => $json->tipo_refeicao,
            'data_refeicao'  => date('Y-m-d') // Data atual
        ];

        // 3. Instancia e salva (usando o helper model() para ser mais rápido)
        $refeicoesModel = model(RefeicoesUserModel::class);

        if ($refeicoesModel->insert($data)) {
            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setStatusCode(400)->setJSON(['success' => false]);
    }
}
