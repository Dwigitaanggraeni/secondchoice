<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ProductsM extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ["id", "nama_produk", "harga_produk", "jenis", "size", "image"];

    public function searchableAs()
{
    return 'products';
}

public function toSearchableArray()
{
    return [
        'nama_produk'      => $this->nama_produk,
    ];
}
}
