<?php

namespace App\Models\Bencana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna'; // Nama tabel
    protected $fillable = ['url_foto'.'nama_lengkap', 'username', 'password']; // Kolom yang dapat diisi
}