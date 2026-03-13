<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\UserModel;
use App\Models\WaterModel;
use App\Models\ReceitaIngredienteModel;

class Dashboard extends BaseController
{

    protected $receitaIngredientesModel;
    protected $recipeModel;
    protected $waterModel;
    protected $userId;

    public function __construct()
    {
        $this->receitaIngredientesModel = new ReceitaIngredienteModel();
        $this->recipeModel = new RecipeModel();
        $this->userId = new UserModel();
        $this->waterModel = new WaterModel();

        helper('auth'); // se você tiver helpers de autenticação
        helper('nutrition');
        helper(['macro']);
        helper('meal');
    }

    public function index()
    {
        $water = $this->waterModel->today(session('id'));

        $data = [
            'water' => $water['quantidade_ml'] ?? 0,
            'todayData' => [
                'meals' => [
                    'breakfast' => [],
                    'lunch' => [],
                    'dinner' => [],
                    'snack' => []
                ]
            ],
            'title' => '',
            'style' => 'style',
            'style2' => 'dashboard',
            'javascript' => 'dashboard'
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/index', $data);
        echo view('includes/footer', $data);
    }

    public function updateWater()
    {
        $userId = session('id');
        $glasses = (int) $this->request->getPost('glasses');

        $today = date('Y-m-d');

        $exists = $this->waterModel
            ->where('usuario_id', $userId)
            ->where('data_registro', $today)
            ->first();

        if ($exists) {

            $this->waterModel->update($exists['id'], [
                'quantidade_ml' => $glasses
            ]);
        } else {

            $this->waterModel->insert([
                'usuario_id' => $userId,
                'quantidade_ml' => $glasses,
                'data_registro' => $today
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'glasses' => $glasses
        ]);
    }

    public function receitas()
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
        echo view('dashboard/recipes', $data);
        echo view('includes/footer', $data);
    }

    // ... suas outras funções (index, updateWater, receitas)

    public function detalhes($id)
    {
        // 1. Busca a receita com os macros usando o Model que já está no seu construtor
        $receita = $this->recipeModel->getReceitaComMacros($id);

        if (!$receita) {
            return $this->response->setStatusCode(404)->setJSON(['erro' => 'Receita não encontrada']);
        }

        // 2. Busca os ingredientes
        $ingredientes = $this->receitaIngredientesModel->getIngredientesDaReceita($id);

        // 3. Monta o array final
        $receita['lista_ingredientes'] = $ingredientes;

        // 4. Retorna em JSON para o seu JavaScript ler
        return $this->response->setJSON($receita);
    }
}
