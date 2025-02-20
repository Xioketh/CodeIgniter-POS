<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;

class TestDB extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DATABASE() as db_name");
        return $query->getResult();
    }
}
