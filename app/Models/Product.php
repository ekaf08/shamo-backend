<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use SoftDeletes, HasApiTokens, HasFactory;

    protected $guarded = [];
    protected $table   = 'product';

    // TODO relasi one to many dengan tabel galleries
    public function galleries()
    {
        return $this->hasMany(ProductGalleries::class, 'product_id', 'id');
    }

    // TODO relasi many (N: product) to one (1: product_categories) / kebalikan dari relasi has many yang ada di model ProductCategories
    public function category()
    {
        $data = $this->belongsTo(ProductCategories::class, 'categories_id', 'id');
        return $data;
    }
}
