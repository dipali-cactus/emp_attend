<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserSubmenuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 2,
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
                'constraint' => 3,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('menu_id');
        $this->forge->createTable('user_submenu');
    }

    public function down()
    {
        $this->forge->dropTable('user_submenu');
    }
}
