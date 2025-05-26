<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class ProductGalleries extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $guarded = [];
    protected $table   = 'product_galleries';
}
