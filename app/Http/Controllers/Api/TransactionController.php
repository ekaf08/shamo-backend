<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
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
}
