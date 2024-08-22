<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAccessTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 2,
                'auto_increment' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('menu_id');
        $this->forge->addKey('role_id');
        $this->forge->createTable('user_access');
    }

    public function down()
    {
        $this->forge->dropTable('user_access');
    }
}
