<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table            = 'ulasan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_klien', 
        'profesi', 
        'komentar', 
        'rating', 
        'avatar_url',
        'status'
    ];
}