<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $guarded = [];
    protected $table   = 'product';
}
