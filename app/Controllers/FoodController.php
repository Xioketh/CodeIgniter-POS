<?php

namespace App\Controllers;
use App\Models\FoodModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Query;

class FoodController extends Controller
{
    public function index()
    {
        $foodModel = new FoodModel();

        // Join foods with categories and fetch all
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT foods.id, foods.name, foods.price, categories.name as category
            FROM foods
            INNER JOIN categories ON foods.category_id = categories.id
        ");

        $foods = $query->getResultArray();
        $data['categories'] = [];

        // Group foods by category
        foreach ($foods as $food) {
            $data['categories'][$food['category']][] = $food;
        }

        return view('food_list', $data);
    }
}
