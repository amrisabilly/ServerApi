<?php

namespace App\Models\AplikasiCoffe;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $table = 'table_order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
