<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nome',
        'email',
        'senha',
        'idade',
        'peso',
        'altura'
    ];

    public function allUsers()
    {
        return $this -> findAll();
    }

    public function findByEmail($email)
    {
        return $this -> where('email', $email)->first();
    }

    public function findById($id)
    {
        return $this -> where('id', $id)->first();
    }
}