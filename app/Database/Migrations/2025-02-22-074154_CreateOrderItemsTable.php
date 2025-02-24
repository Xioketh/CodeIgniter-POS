<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
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
            'food_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'food_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'qty' => [
                'type'       => 'int',
                'null' => false,
            ],
            'unit_price' => [
                'type'       => 'DOUBLE',
                'constraint' => '10,2',
                'null' => false,
            ],
            'total' => [
                'type'       => 'DOUBLE',
                'constraint' => '10,2',
                'null' => false,
            ],
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ]
        ]);
        $this->forge->addKey('id', true); // Add primary key
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
    }
}
