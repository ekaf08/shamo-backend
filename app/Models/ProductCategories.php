<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ProductCategories extends Model
{
    use HasApiTokens, SoftDeletes, HasFactory;

    protected $table   = 'product_categories';
    protected $guarded = [];

    // TODO relasi one to many dengan tabel product
    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }
}
