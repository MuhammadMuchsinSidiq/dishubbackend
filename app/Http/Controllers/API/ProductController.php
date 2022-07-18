<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\tiket;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $nama_tiket = $request->input('nama_tiket');
        $limit = $request->input('limit', 6);
        // $harga =$request->input('harga');
        $kloter = $request->input('kloter');
        $deskripsi = $request->input('deskripsi');

        if ($id) {
            $tiket = tiket::with(['items', 'galeri_tiket'])->find($id);

            if ($tiket) {
                return ResponseFormatter::success(
                    $tiket,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }
        $tiket = tiket::with(['items', 'galeri_tiket']);

        if ($nama_tiket) {
            $tiket->where('nama_tiket', 'Like', '%' . $nama_tiket . '%');
        }

        if ($kloter) {
            $tiket->where('kloter', 'Like', '%' . $tiket . '%');
        }

        if ($deskripsi) {
            $tiket->where('deskripsi', 'Like', '%' . $deskripsi . '%');
        }

        return ResponseFormatter::success(
            $tiket->paginate($limit),
            'Data produk berhasil diambil'
        );
    }
}
