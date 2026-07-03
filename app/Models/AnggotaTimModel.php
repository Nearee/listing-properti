<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaTimModel extends Model
{
    protected $table            = 'anggota_tim';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama', 
        'jabatan', 
        'deskripsi', 
        'foto_url', 
        'link_twitter', 
        'link_facebook', 
        'link_linkedin', 
        'link_instagram'
    ];
}