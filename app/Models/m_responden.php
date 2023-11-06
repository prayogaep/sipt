<?php

namespace App\Models;

use CodeIgniter\Model;

class m_responden extends Model
{
    protected $table            = 'tbl_responden';
    protected $primaryKey       = 'id_responden';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tanggal', 'nama_responden', 'alamat', 'jenis_kelamin', 'umur', 'ks', 'rating'
    ];

    function filterDate($from, $to = null) {
        $this->where('tanggal >=', $from);
        if ($to) {
            $this->where('tanggal <=', $to);
        }
        return $this->get()->getResultArray();
    }
    function checkIpResponden($p)
    {
        $query = "SELECT * FROM tbl_ip WHERE ip_address = '$p'";
        return $this->runQuery($query)->getResult();
    }
    function penilaianRasio($nilai) {
        $keterangan = '';
        if ($nilai == 5 ) {
            $keterangan = 'Sangat Puas';
        } else if ($nilai >= 4 && $nilai < 5) {
            $keterangan = 'Puas';
        } else if ($nilai >= 3 && $nilai < 4) {
            $keterangan = 'Biasa saja';
        } else if ($nilai >= 2 && $nilai < 3) {
            $keterangan = 'Tidak Puas';
        } else {
            $keterangan = 'Sangat Tidak Puas';
        }
        return $keterangan;
    }
    function getRasio()
    {
        $rasio = $this->runQuery("SELECT (result/responden) rasio FROM ( SELECT
                SUM(total) result, (SELECT COUNT(*) responden from tbl_responden) responden
                FROM
                    (
                    SELECT
                        (rate * rating) total
                    FROM
                        (
                        SELECT
                            COUNT(rating) rate,
                            rating
                        FROM
                            tbl_responden
                        GROUP BY
                            Rating
                    ) A
                GROUP BY
                    (rate * rating)
                ) A ) A; 
        ")->getRowArray();
        return $rasio;
    }
    public function runQuery($query)
    {
        return $this->db->query($query);
    }
}
