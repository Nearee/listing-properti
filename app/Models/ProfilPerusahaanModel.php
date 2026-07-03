<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilPerusahaanModel extends Model
{
    protected $table            = 'profil_perusahaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // Bisa diubah ke 'object' jika lebih suka OOP style
    protected $allowedFields    = [
        'deskripsi_tentang', 
        'teks_visi', 
        'teks_misi', 
        'alamat_kantor', 
        'jam_operasional', 
        'email_kantor', 
        'telepon_kantor'
    ];

    protected $useTimestamps = false;

}