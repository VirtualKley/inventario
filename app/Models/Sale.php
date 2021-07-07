<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function salesProducts(){
        return $this->belongsToMany(Product::class)
        ->withPivot('cantidad', 'precio_compra', 'subtotal_compra', 'precio_venta', 'subtotal_venta', 'created_at', 'updated_at');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
