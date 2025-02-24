<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFoodsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'price' => [
                'type' => 'DOUBLE',
                'constraint' => '10,2',
                'null' => true,
            ],
            'is_active' => [
                'type' => 'INT',
                'null' => false,
                'default' => 1
            ],
            'category_id' => [
                'type' => 'INT',
                'null' => false
            ]
        ]);
        $this->forge->addKey('id', true); // Add primary key
        $this->forge->createTable('foods');

        // Add predefined categories
        $builder = $this->db->table('foods');
        $foods = [
            // burgers
            ['name' => 'Crispy Chicken', 'price' => 1000, 'category_id' => 1],
            ['name' => 'Double Crispy Chicken', 'price' => 1500, 'category_id' => 1],
            ['name' => 'Beef 100g', 'price' => 1400, 'category_id' => 1],
            ['name' => 'Double Beef 200g', 'price' => 1600, 'category_id' => 1],
            ['name' => 'Veggie Mix', 'price' => 900, 'category_id' => 1],
            ['name' => 'Omelette', 'price' => 600, 'category_id' => 1],

            // wraps
            ['name' => 'Crispy Chicken', 'price' => 1000, 'category_id' => 2],
            ['name' => 'Double Crispy Chicken', 'price' => 1500, 'category_id' => 2],
            ['name' => 'Beef 100g', 'price' => 1300, 'category_id' => 2],
            ['name' => 'Double Beef 200g', 'price' => 1600, 'category_id' => 2],
            ['name' => 'Veggie Mix', 'price' => 900, 'category_id' => 2],
            ['name' => 'Full Avocado', 'price' => 700, 'category_id' => 2],
            ['name' => 'Scramble Eggs', 'price' => 600, 'category_id' => 2],
            ['name' => 'Avocado & Scramble Eggs', 'price' => 900, 'category_id' => 2],
            ['name' => 'Cow Cheese, Tomato, Pepper', 'price' => 850, 'category_id' => 2],

            // hotdogs
            ['name' => 'Chicken Sausage', 'price' => 1000, 'category_id' => 3],
            ['name' => 'Crispy Chicken', 'price' => 1000, 'category_id' => 3],
            ['name' => 'Beef 100g', 'price' => 1400, 'category_id' => 3],
            ['name' => 'Scramble Eggs', 'price' => 600, 'category_id' => 3],


            // VEG
            ['name' => 'Veggie Mix Burger', 'price' => 900, 'category_id' => 4],
            ['name' => 'Omelette Burger', 'price' => 600, 'category_id' => 4],
            ['name' => 'Veggie Mix Wrap', 'price' => 900, 'category_id' => 4],
            ['name' => 'Full Avocado Wrap', 'price' => 700, 'category_id' => 4],
            ['name' => 'Scramble Eggs Wrap', 'price' => 600, 'category_id' => 4],
            ['name' => 'Avocado & Scramble Eggs Wrap', 'price' => 900, 'category_id' => 4],
            ['name' => 'Scramble Eggs Hotdog', 'price' => 600, 'category_id' => 4],

            // VEGAN
            ['name' => 'Veggie Mix Burger', 'price' => 900, 'category_id' => 5],
            ['name' => 'Veggie Mix Wrap', 'price' => 900, 'category_id' => 5],
            ['name' => 'Full Avocado Wrap', 'price' => 700, 'category_id' => 5],

            // MUNCHEES
            ['name' => 'Special Wrap', 'price' => 1200, 'category_id' => 6],


            // THIRSTY
            ['name' => 'Water Bottle (500ml)', 'price' => 100, 'category_id' => 7],
            ['name' => 'Coca Cola', 'price' => 150, 'category_id' => 7],
            ['name' => 'Fresh Coffee', 'price' => 200, 'category_id' => 7],

            // Add On
            ['name' => 'One Egg', 'price' => 100, 'category_id' => 8],
            ['name' => 'Extra Cheese', 'price' => 200, 'category_id' => 8]
        ];
        $builder->insertBatch($foods); // Insert the predefined $foods
    }

    public function down()
    {
        $this->forge->dropTable('foods');
    }
}
