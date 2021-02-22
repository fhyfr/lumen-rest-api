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
    public function show($id)
    {
        $produk = Produk::find($id);
        if(!$produk) {
            return response()->json(['status' => 404, 'message' => 'Data produk not found!'], 404);
        }

        return response()->json($produk);
    }

    // create data produk
    public function create(Request $request)
    {
        // validasi data produk
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

    // update data produk
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if(!$produk) {
            return response()->json(['status' => 404, 'message' => 'Data produk not found!'], 404);
        }

        $this->validate($request, [
            'nama'=>'string',
            'harga'=>'integer',
            'warna'=>'string',
            'kondisi'=>'in:baru,lama',
            'deskripsi'=>'string'
            ]);
            
        $data = $request->all();
        $produk->fill($data);
        $produk->save();

        return response()->json($produk);
    }

    // delete data produk
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if(!$produk) {
            return response()->json(['status' => 404, 'message' => 'Data produk not found!'], 404);
        }

        $produk->delete();
        return response()->json(['message'=>'Produk sucessfully deleted!']);
    }
}