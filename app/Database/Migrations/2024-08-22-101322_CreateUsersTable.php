<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username' => [
                'type' => 'CHAR',
                'constraint' => '6',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'zerofill' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey('username');
        $this->forge->addKey('employee_id');
        $this->forge->addKey('role_id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
