<?php

namespace App\Models;

use CodeIgniter\Model;

class m_ip extends Model
{
    protected $table            = 'tbl_ip';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'ip_address'
    ];
}
