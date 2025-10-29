<?php

namespace App\Models\Bencana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna'; // Nama tabel
    protected $fillable = ['nama_lengkap', 'username', 'password']; // Kolom yang dapat diisi
}