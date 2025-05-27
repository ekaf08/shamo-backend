<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class ProductGalleries extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $guarded = [];
    protected $table   = 'product_galleries';

    // TODO relasi many (N: product_galleries) to one (1: product) / kebalikan dari relasi has many yang ada di model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // TODO agar URL yang di gunakan API muncul full tanpa terpotong
    public function getAttributeUrl($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
