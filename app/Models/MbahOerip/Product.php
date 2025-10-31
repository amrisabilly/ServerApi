<?php

namespace App\Models\MbahOerip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'mbah_oerip_products';

    protected $fillable = [
        'name',
        'image',
    ];
}
