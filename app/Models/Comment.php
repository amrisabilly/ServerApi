<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'article_id',
        'parent_id',
        'name',
        'comment',
    ];

    /**
     * Relasi: Komentar ini milik sebuah artikel
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relasi: Balasan dari komentar ini
     */
    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Relasi: Komentar induk dari komentar ini
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
