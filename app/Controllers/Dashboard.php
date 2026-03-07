<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        //helper('auth'); // se você tiver helpers de autenticação
    }

    public function index(): string {
        return view('dashboard/index');
    }
}