<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\TransactionsItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id     = $request->input('id');
        $limit  = $request->input('limit', 6);
        $status = $request->input('status');

        if ($id) {
            $transaction = Transactions::with(['items.product'])->find($id);

            if ($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'Transaksi ditemukan 1'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Transaksi tidak ditemukan',
                    404
                );
            }
        }

        $transaction = Transactions::with(['items.product'])->where('user_id', auth()->user()->id)->get();
        // dd($transaction->toRawSql());

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction,
            'Transaksi ditemukan2'
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items'          => 'required|array',
            'items.*.id'     => 'exists:product,id',
            'total_price'    => 'required',
            'shipping_price' => 'required',
            'status'         => 'required|in:PENDING, SUCCESS. CANCELLED, FAILED, SHIPPING, SHIPPED'
        ]);

        $transaction = Transactions::create([
            'user_id'        => auth()->user()->id,
            'address'        => $request->address,
            'total_price'    => $request->total_price,
            'shipping_price' => $request->shipping_price,
            'status'         => $request->status
        ]);

        foreach ($request->items as $product) {
            TransactionsItem::create([
                'user_id'        => auth()->user()->id,
                'product_id'     => $product['id'],
                'transaction_id' => $transaction->id,
                'quantity'       => $product['quantity']
            ]);
        }

        return ResponseFormatter::success(
            $transaction->load('items.product'),
            'Transaksi Berhasil'
        );
    }
}
