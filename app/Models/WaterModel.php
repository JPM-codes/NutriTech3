<?php

namespace App\Models;

use CodeIgniter\Model;

class WaterModel extends Model
{
    protected $table = 'controle_agua';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'quantidade_ml',
        'data_registro'
    ];

    public function findByUser($id)
    {
        return $this->where('usuario_id', $id)->first();
    }

    public function today($userId)
    {
        return $this->where('usuario_id', $userId)
                    ->first();
    }

    public function setTodayWater($userId, $glasses)
    {
        $today = $this->today($userId);

        if ($today) {

            return $this->update($today['id'], [
                'quantidade_ml' => $glasses
            ]);

        }

        return $this->insert([
            'usuario_id' => $userId,
            'quantidade_ml' => $glasses,
            'data_registro' => date('Y-m-d')
        ]);
    }
}