<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\detail_transaksi;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $status = $request->input('status');

        if($id)
        {
            $transaction = transaksi::with(['items.tiket'])->find($id);

            if($transaction)
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
        }

        $transaction = transaksi::with(['items.tiket'])->where('id_user', Auth::user()->id);

        if($status)
            $transaction->where('status', $status);

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'exists:tiket,id',
            'total_harga' => 'required',
            'status' => 'required|in:PENDING,SUCCESS,CANCELLED,FAILED',
        ]);

        $transaction = transaksi::create([
            'id_user' => Auth::user()->id,
            'pembayaran' => $request->pembayaran,
            'total_harga' => $request->total_harga,
            'status' => $request->status
        ]);
        
        foreach ($request->items as $product) {
            detail_transaksi::create([
                'id_user' => Auth::user()->id,
                'id_tiket' => $product['id'],
                'id_transaksi' => $transaction->id,
                'quantity' => $product['quantity']
            ]);
        }

        return ResponseFormatter::success($transaction->load('items.tiket'), 'Transaksi berhasil');
    }
}
