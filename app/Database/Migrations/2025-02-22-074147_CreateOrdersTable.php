<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
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
            'order_date' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'tot_qty' => [
                'type'       => 'int',
                'null' => false,
            ],
            'total_price' => [
                'type'       => 'DOUBLE',
                'constraint' => '10,2',
                'null' => false,
            ],
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'status' => [
                'type' => 'INT',
                'null' => false
            ]
        ]);
        $this->forge->addKey('id', true); // Add primary key
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}

