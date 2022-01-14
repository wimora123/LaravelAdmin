<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Categories;

class ApiMerchant extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Merchant::join('categories', 'merchants.id_kategori', '=', 'categories.id')
        ->select(['merchants.*', 'categories.name_category'])
        ->paginate(5);

        return response()->json([
            'data' => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $barang = new Merchant;

        $namaBarang = $request->namaBarang;
        $kategori = $request->kategori;
        $harga = $request->hargaBarang;
        $qty = $request->qty;
        $description = $request->description;
        $status = $request->status;

        $barang->name_merchant = $namaBarang; 
        $barang->id_kategori = $kategori; 
        $barang->price = $harga; 
        $barang->quantity = $qty; 
        $barang->description = $description; 
        $barang->status = $status; 

        $barang->save();

        return response()->json([
            'message' => "Data berhasil diinput"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Merchant::join('categories', 'merchants.id_kategori', '=', 'categories.id')
        ->where('merchants.id', '=', $id)
        ->get(['merchants.*', 'categories.name_category'])
        ->first();

        return response()->json([
            'data' => $barang
        ]);
    }

    public function update(Request $request, $id)
    {
        $barang = Merchant::where('id', $id)->first();

        $namaBarang = $request->namaBarang;
        $kategori = $request->kategori;
        $harga = $request->hargaBarang;
        $qty = $request->qty;
        $description = $request->description;
        $status = $request->status === 1 ? true : false;

        $barang->name_merchant = $namaBarang ? $namaBarang : $barang->name_merchant; 
        $barang->id_kategori = $kategori ? $kategori : $barang->id_kategori; 
        $barang->price = $harga ? $harga : $barang->price; 
        $barang->quantity = $qty ? $qty : $barang->quantity; 
        $barang->description = $description ? $description : $barang->description; 
        $barang->status = $status ? $status : $barang->status;
        
        // Nah kita buat status === 1 dulu, jangan status === 0 dulu nanti hasilnya saat edit ke false lagi, baliknya true terus
        if($barang->status === 1){
            $barang->update(['status' => false]);
        }
        else if($barang->status === 0){
            $barang->update(['status' => true]);
        }
        else if($barang->status > 1){
            return "Status not valid. Please input true as active and false as not active";
        }

        return response()->json([
            'message' => "Data berhasil diedit",
            'data' => $barang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Merchant::where('id', $id)->first();
        $barang->delete();
        return response()->json([
            'message' => "Data berhasil dihapus"
        ]);
        
    }
}
