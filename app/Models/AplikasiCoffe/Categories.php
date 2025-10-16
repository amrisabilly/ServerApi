<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'table_categories';

    protected $fillable = [
        'name',
        'description',
    ];
}
