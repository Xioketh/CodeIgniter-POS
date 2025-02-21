<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'INT',
                'null' => false,
                'default' => 1
            ]
        ]);
        $this->forge->addKey('id', true); // Add primary key
        $this->forge->createTable('categories');

        // Add predefined categories
        $builder = $this->db->table('categories');
        $categories = [
            ['name' => 'Burger', 'is_active' => 1],
            ['name' => 'Rice', 'is_active' => 1],
            ['name' => 'Drinks', 'is_active' => 1],
            ['name' => 'Add Ons', 'is_active' => 1]
        ];
        $builder->insertBatch($categories); // Insert the predefined categories
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
