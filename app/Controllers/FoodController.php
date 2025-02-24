<?php

namespace App\Controllers;

use App\Models\FoodModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class FoodController extends Controller
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('add_food', $data);
    }

    public function addFood()
    {
        $request = service('request');

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[50]',
            'price' => 'required|numeric|greater_than[0]',
            'category_id' => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $validation->getErrors()]);
        }

        $foodModel = new FoodModel();
        $foodData = [
            'name' => $request->getPost('name'),
            'price' => $request->getPost('price'),
            'category_id' => $request->getPost('category_id')
        ];

        if ($foodModel->insert($foodData)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Food item added successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add food item']);
        }
    }
}
