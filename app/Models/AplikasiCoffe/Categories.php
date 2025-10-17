<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'table_categories';

    protected $fillable = [
        'name',
        'description',
    ];
}
