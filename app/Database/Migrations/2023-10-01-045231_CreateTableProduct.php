<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->createTable('tbl_produk');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_produk');
    }
}
