<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

   protected $table = 'barang';
    protected $primaryKey = 'sku';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'sku',
        'nama_barang',
        'kategori',
        'satuan',
    ];
}