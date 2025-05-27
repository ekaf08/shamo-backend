<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function all(Request $request)
    {
        $id           = $request->input('id');
        $limit        = $request->input('limit');
        $name         = $request->input('name');
        $show_product = $request->input('show_product');

        if ($id) {
            $category = ProductCategories::with(['products'])->find($id);

            if ($category) {
                return ResponseFormatter::success(
                    $category,
                    'Kategori Produk Berhasil Di Temukan!'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Kategori Produk Tidak Di Temukan!',
                    404
                );
            }
        }

        $category = ProductCategories::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%');
        }

        if ($show_product) {
            $category->with('products');
        }
        // dd($category, $request->all());

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Kategori Produk Di Temukan'
        );
    }
}
