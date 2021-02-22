<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    // get data produk
    public function index(){
        $produk = Produk::all();
        return response()->json($produk);
    }

    // show data by id
    public function show($id){
        $produk = Produk::find($id);
        return response()->json($produk);
    }

    // create data produk
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