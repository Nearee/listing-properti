<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanMasukModel extends Model
{
    protected $table            = 'pesan_masuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_pengirim', 
        'email', 
        'subjek', 
        'pesan'
    ];

    // Menggunakan automatic timestamps untuk created_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Kosongkan karena di tabel tidak ada kolom updated_at
}