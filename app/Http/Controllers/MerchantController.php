<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormValidation;
use App\Merchant;
use App\Categories;


class MerchantController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('adminLogin')->with('failed', 'Login dulu!!!');
        }

        // $barang = Merchant::paginate(5);

        $barang = Merchant::join('categories', 'merchants.id_kategori', '=', 'categories.id')
        ->select(['merchants.*', 'categories.name_category'])
        ->paginate(5);
        
        return view('adminDashboard.list')->with('barang', $barang);
    }

    public function create()
    {
        if(!auth()->check()){
            return redirect()->route('adminLogin')->with('failed', 'Login dulu!!!');
        }
        

        $categories = Categories::all();
        return view('adminDashboard.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'namaBarang' => 'required',
            'kategori' => 'required',
            'hargaBarang' => 'required',
            'qty' => 'required',
            'description' => 'required'
        ]);

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
        return redirect()->route('listMerchant')->with('success', 'Data berhasil ditambah');
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
        if(!auth()->check()){
            return redirect()->route('adminLogin')->with('failed', 'Login dulu!!!');
        }

        // $barang = Merchant::where('id',$id)->first();

        $barang = Merchant::join('categories', 'merchants.id_kategori', '=', 'categories.id')
        ->where('merchants.id', '=', $id)
        ->get(['merchants.*', 'categories.name_category'])
        ->first();

         $categories = Categories::all();

        return view('adminDashboard.edit')->with('barang', $barang)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        
        if($barang->status === 1){
            $barang->update(['status' => false]);
        }
        else{
            $barang->update(['status' => true]);
        }
        return redirect()->route('listMerchant')->with('success', 'Data berhasil diedit');
    }

    public function editStatus(Request $request)
    {
        // find itu digunakan untuk mencari di table berdasarkan id. Tetapi find juga bisa digunakan untuk menemukan id berdasarkan id di ajax, bukan di DB saja
        $barang = Merchant::find($request->idbarang);
        $barang->status = $request->status;
        $barang->save();
        
        // if($barang->status === 1){
        //     $barang->update(['status' => false]);
        // }
        // else if($barang->status === 0){
        //     $barang->update(['status' => true]);
        // }
       
        return response()->json(['success'=>'Status change successfully.']);
    }

 
    public function destroy($id)
    {
          $barang = Merchant::where('id', $id)->first();
          $barang->delete();
          return redirect()->route('listMerchant')->with('success', 'Data berhasil dihapus');
    }
}
