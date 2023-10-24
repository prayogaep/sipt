<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableResponden extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_responden' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type'       => 'DATE',
            ],
            'nama_responden' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'umur' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'pertanyaan_1' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_2' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_3' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_4' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_5' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_6' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_7' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_8' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_9' => [
                'type'       => 'TEXT',
            ],
            'pertanyaan_10' => [
                'type'       => 'TEXT',
            ],
            'rating' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],

        ]);
        $this->forge->addKey('id_responden', true);
        $this->forge->createTable('tbl_responden');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_responden');
    }
}
