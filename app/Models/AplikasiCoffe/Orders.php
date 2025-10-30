<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'table_orders';

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'discount'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(Order_items::class, 'order_id');
    }
}
