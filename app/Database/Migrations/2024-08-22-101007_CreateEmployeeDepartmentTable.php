<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeDepartmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 3,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'zerofill' => true,
            ],
            'department_id' => [
                'type' => 'CHAR',
                'constraint' => '3',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('employee_id');
        $this->forge->addKey('department_id');
        $this->forge->createTable('employee_department');
    }

    public function down()
    {
        $this->forge->dropTable('employee_department');
    }
}
