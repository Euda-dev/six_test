<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'status',
        'value',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_product');
    }

    public function stocks()
    {
        return $this->hasOne(Stock::class,'id_product'); // hasOne significa 1 para 1 - 1 produto no estoque
    }
}
