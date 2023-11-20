<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'cpf',
        'id_product',
        'quantity',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product'); // belongsTo significa 1 pra 1 quando se tem chave estrangeira- 1 pedido tem 1 produto
    }
}
