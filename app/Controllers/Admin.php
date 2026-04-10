<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\RecipeModel;
use App\Models\UserModel;

class Admin extends BaseController 
{
    public function index() {

        $userModel = new UserModel();
        $receitasModel = new RecipeModel();
        $alimentosModel = new FoodModel();
        $data = 
        [
            'totalUsuarios' => $userModel->countAllResults(),
            'totalReceitas' => $receitasModel->countAllResults(),
            'totalAlimentos' => $alimentosModel->countAllResults(),
        ];

        return view('admin/index', $data);
    }
}