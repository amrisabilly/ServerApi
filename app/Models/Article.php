<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
     protected $fillable = [
        'title',
        'content',
        'author',
    ];

    /**
     * Relasi: Satu artikel punya banyak komentar
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
