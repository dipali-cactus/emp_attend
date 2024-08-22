<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttendanceTable extends Migration
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
            'username' => [
                'type' => 'CHAR',
                'constraint' => '6',
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
            'shift_id' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'location_id' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'in_time' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'notes' => [
                'type' => 'VARCHAR',
                'constraint' => '120',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'lack_of' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
            ],
            'in_status' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'out_time' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'out_status' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('username');
        $this->forge->addKey('employee_id');
        $this->forge->addKey('department_id');
        $this->forge->addKey('shift_id');
        $this->forge->addKey('location_id');
        $this->forge->createTable('attendance');
    }

    public function down()
    {
        $this->forge->dropTable('attendance');
    }
}
