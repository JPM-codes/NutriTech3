<?php

namespace App\Models;

use CodeIgniter\Model;

class MealModel extends Model
{
    protected $table = 'meals';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'food_id',
        'meal_type',
        'quantity'
    ];
}