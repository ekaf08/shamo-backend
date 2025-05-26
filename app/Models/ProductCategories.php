<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ProductCategories extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $table   = 'product_categories';
    protected $guarded = [];
}
