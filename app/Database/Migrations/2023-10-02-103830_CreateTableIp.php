<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableIp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_ip');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_ip');
    }
}
