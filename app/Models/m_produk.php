<?php

namespace App\Models;

use CodeIgniter\Model;

class m_produk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_produk', 'deskripsi', 'foto'];
}
