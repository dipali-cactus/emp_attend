<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyAttendence extends Migration
{
    public function up()
    {
        $this->forge->addForeignKey('username', 'users', 'username', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_id', 'employee', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('department_id', 'department', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('shift_id', 'shift', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('location_id', 'location', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('attendance', 'attendance_ibfk_1');
        $this->forge->dropForeignKey('attendance', 'attendance_ibfk_2');
        $this->forge->dropForeignKey('attendance', 'attendance_ibfk_3');
        $this->forge->dropForeignKey('attendance', 'attendance_ibfk_4');
        $this->forge->dropForeignKey('attendance', 'attendance_ibfk_5');
    }
    
}
