<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoranModel extends Model
{
    protected $table            = 'setoran';
    protected $primaryKey       = 'id_setoran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_warga', 'kode_trx', 'nominal', 'tanggal', 'metode', 
        'keterangan', 'status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
