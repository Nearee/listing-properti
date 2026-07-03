<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertiModel extends Model
{
    protected $table            = 'properti';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'blok_id', 
        'nama_properti', 
        'nomor_rumah', 
        'harga', 
        'kamar_tidur', 
        'kamar_mandi', 
        'gambar_url', 
        'kategori_tampil'
    ];

    // Menggunakan automatic timestamps untuk created_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Kosongkan karena di tabel tidak ada kolom updated_at
}