<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\UserModel;
use App\Models\WaterModel;

class Dashboard extends BaseController
{

    protected $recipeModel;
    protected $waterModel;
    protected $userId;

    public function __construct()
    {
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
            'water' => $water['glasses'] ?? 0,
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
            ->where('user_id', $userId)
            ->where('log_date', $today)
            ->first();

        if ($exists) {

            $this->waterModel->update($exists['id'], [
                'glasses' => $glasses
            ]);
        } else {

            $this->waterModel->insert([
                'user_id' => $userId,
                'glasses' => $glasses,
                'log_date' => $today
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'glasses' => $glasses
        ]);
    }

    public function recipes()
    {

        $data = [
            'title' => '',
            'style' => 'style',
            'style2' => 'recipes',
            'javascript' => 'recipes',
            'recipes' => $this->recipeModel->allRecipes(),
        ];

        echo view('includes/header', $data);
        echo view('includes/navbar', $data);
        echo view('dashboard/recipes', $data);
        echo view('includes/footer', $data);
    }
}
