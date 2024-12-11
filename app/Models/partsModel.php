<?php
namespace App\Models;

use CodeIgniter\Model;

class partsModel extends Model
{
    protected $table = 'parts'; // Nama tabel di database
    protected $primaryKey = 'idparts'; // Primary key tabel
    protected $allowedFields = ['namaparts', 'price', 'suite', 'icon']; // Kolom yang bisa diisi
}
