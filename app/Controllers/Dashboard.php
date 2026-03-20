<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\UserModel;
use App\Models\WaterModel;
use App\Models\ReceitaIngredienteModel;
use App\Models\RefeicoesUserModel;

class Dashboard extends BaseController
{

    protected $receitaIngredientesModel;
    protected $recipeModel;
    protected $waterModel;
    protected $userId;
    protected $refeicoesUser;

    public function __construct()
    {
        $this->receitaIngredientesModel = new ReceitaIngredienteModel();
        $this->recipeModel = new RecipeModel();
        $this->userId = new UserModel();
        $this->waterModel = new WaterModel();
        $this->refeicoesUser = new RefeicoesUserModel();

        helper('auth'); // se você tiver helpers de autenticação
        helper('nutrition');
        helper('macro');
        helper('meal');
    }

    public function index()
    {
        $water = $this->waterModel->today(session('id'));

        $dadosHoje = $this->refeicoesUser->getAllReceitasHoje(session('id'));

        $refeicoesAgrupadas = [
            'cafe' => [],
            'almoco' => [],
            'jantar' => [],
            'lanche' => [],
        ];

        foreach ($dadosHoje as $ref) {
            $tipo = $ref['tipo_refeicao']; // ex: 'cafe', 'almoco', 'jantar'
            $refeicoesAgrupadas[$tipo][] = $ref;
        }
        $data = [
            'water' => $water['quantidade_ml'] ?? 0,
            'todayData' => $refeicoesAgrupadas,
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
}
