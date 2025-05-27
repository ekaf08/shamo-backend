<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductGalleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductGalleriesController extends Controller
{
    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'url'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        // dd($request->all());

        if ($validator->fails()) {
            return ResponseFormatter::error(
                null,
                $validator->errors(),
                422
            );
        }

        // simpan gambar ke storage
        $path = $request->file('url')->store('public/galeri_produk', 'public');

        // simpan ke database
        $galeri = ProductGalleries::create([
            'product_id' => $request->product_id,
            'url' => $path
        ]);

        return ResponseFormatter::success(
            $galeri,
            'Foto Produk Berhasil Ditambahkan!'
        );
    }
}
