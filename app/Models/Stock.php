<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product');
    }
}
