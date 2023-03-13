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
            //foreign key hanya bisa diisi oleh user dengan tipe seller
            $user = User::where('tipe', 's')->first();
            if ($user !== null) {
                $barang = new Barang;
                $barang->nama_barang = $data['nama_barang'];
                $barang->harga = $data['harga'];
                $barang->user_id = $user->id;
                $barang->save();
                return response()->json($barang);
            } else {
                //return bila tidak ada user sellere 
                return response()->json([
                    'message' => 'Tidak ada tipe user penjual',
                    'error' => 'User penjual tidak ditemukan'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal Tambah Barang',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
}