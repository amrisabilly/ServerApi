<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'origin_story',
        'price',
        'image_url',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'product_id');
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'product_id', 'user_id');
    }
}
