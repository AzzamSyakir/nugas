<?php

namespace App\Http\Controllers\Barang;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function storeBarang(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|integer',
        ]);
        try {
            $user = User::where('tipe', 's')->firstOrFail();
            $barang = new Barang;
            $barang->nama_barang = $data['nama_barang'];
            $barang->harga = $data['harga'];
            $barang->user_id = $user->id;
            $barang->save();
            return response()->json($barang);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal Tambah Barang',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
}
