<?php

namespace App\Models;

use CodeIgniter\Model;

class BlokModel extends Model
{
    protected $table            = 'blok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'lokasi_id', 
        'nama_blok'
    ];

    // Method  untuk  Join dengan tabel lokasi
    public function getBlokWithLokasi()
    {
        return $this->select('blok.*, lokasi.nama_lokasi')
                    ->join('lokasi', 'lokasi.id = blok.lokasi_id')
                    ->findAll();
    }
}