<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserMenuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 2,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
            'order_no' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user_menu');
    }
    
    public function down()
    {
        $this->forge->dropTable('user_menu');
    }
}
