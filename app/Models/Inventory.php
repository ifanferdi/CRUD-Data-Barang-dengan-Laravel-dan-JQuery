<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'kode_barang', 'harga_beli', 'harga_jual', 'stok', 'gambar'];
}
