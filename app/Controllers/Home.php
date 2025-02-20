<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function home(): string
    {
        return view('layout');
    }

    public function products(): string
    {
        return view('food_list');
    }

    public function orders(): string
    {
        return view('orders');
    }

    public function login(): string
    {
        return view('login');
    }
}
