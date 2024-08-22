<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'zerofill' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'gender' => [
                'type' => 'CHAR',
                'constraint' => '1',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'birth_date' => [
                'type' => 'DATE',
            ],
            'hire_date' => [
                'type' => 'DATE',
            ],
            'shift_id' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('shift_id', false, false, 'shift_id_fk_e');
        $this->forge->createTable('employee');
    }

    public function down()
    {
        $this->forge->dropTable('employee');
    }
}
