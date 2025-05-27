<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class TransactionsItem extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $table   = 'transactions_item';
    protected $guarded = [];

    // TODO relasi one to one dengan tabel produk
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
