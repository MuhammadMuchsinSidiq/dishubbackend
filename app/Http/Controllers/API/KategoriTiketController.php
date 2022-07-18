<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategori_tiket;
use App\Helpers\ResponseFormatter;

class KategoriTiketController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $nama_kategori = $request->input('nama_kategori');
        $show_product = $request->input('show_product');


        if ($id) {
            $kategori = kategori_tiket::with(['tikets'])->find($id);

            if ($kategori) {
                return ResponseFormatter::success(
                    $kategori,
                    'Data kategori berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data kategori tidak ada',
                    404
                );
            }
        }

        $kategori = kategori_tiket::query();

        if ($nama_kategori) {
            $kategori->where('nama_tiket', 'Like', '%' . $nama_kategori . '%');
        }

        if($show_product){
            $kategori->with('tikets');
        }

        return ResponseFormatter::success(
            $kategori->paginate($limit),
            'Data List Kategori berhasil ditambah'
        );
    }
}
