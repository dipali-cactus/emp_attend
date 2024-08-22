<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShiftTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 1,
                'auto_increment' => true,
            ],
            'start' => [
                'type' => 'TIME',
            ],
            'end' => [
                'type' => 'TIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('shift');
    }

    public function down()
    {
        $this->forge->dropTable('shift');
    }
}
