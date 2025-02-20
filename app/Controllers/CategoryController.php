<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CategoryModel;
use App\Models\FoodModel;

class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        return view('food_list', ['categories' => $categories]);
    }

    public function getFoods($categoryId)
    {
        $foodModel = new FoodModel();
        $foods = $foodModel->where('category_id', $categoryId)->findAll();

        return $this->response->setJSON($foods);
    }
}
