<?php

namespace App\Models;

use CodeIgniter\Model;

class m_responden extends Model
{
    protected $table            = 'tbl_responden';
    protected $primaryKey       = 'id_responden';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tanggal', 'nama_responden', 'alamat', 'jenis_kelamin', 'umur', 'pertanyaan_1', 'pertanyaan_2', 'pertanyaan_3', 'pertanyaan_4', 'pertanyaan_5', 'pertanyaan_6', 'pertanyaan_7', 'pertanyaan_8', 'pertanyaan_9', 'pertanyaan_10', 'rating'
    ];

    function filterDate($from, $to = null) {
        $this->where('tanggal >=', $from);
        if ($to) {
            $this->where('tanggal <=', $to);
        }
        return $this->get()->getResultArray();
    }
}
