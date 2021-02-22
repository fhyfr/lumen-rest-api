<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    /**
     * The primary key associated with the table.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'harga', 'warna', 'kondisi', 'deskripsi'
    ];
}