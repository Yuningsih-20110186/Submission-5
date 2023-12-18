<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table    = "books";
    protected $fillable = [
        'id',
        'nama_buku',
        'id_penulis',
        'nama_penerbit',
        'tahun_terbit',
        'published_at',
        'created_at',
        'updated_at'
    ];
}
