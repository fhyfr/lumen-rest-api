<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function create(Request $request){
        // validate data produk
        $this->validate($request, [
            'nama'=>'required|string',
            'harga'=>'required|integer',
            'warna'=>'required|string',
            'kondisi'=>'required|in:baru,lama',
            'deskripsi'=>'string'
        ]);

        $data = $request->all();
        $produk = Produk::create($data);

        return response()->json();
    }
}