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
        'url_foto',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
