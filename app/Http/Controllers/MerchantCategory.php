<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;


class MerchantCategory extends Controller
{
	public function index(){
		if(!auth()->check()){
            return redirect()->route('adminLogin')->with('failed', 'Login dulu!!!');
        }
        
		 $categories = Categories::all();
		 return view('adminDashboard.merchantCategory')->with('categories', $categories);
	}

	public function create(Request $request){
		$this->validate($request,[
			'kategori' => 'required|min:3'
		]);

		$category = new Categories;
		$namaKategori = $request->kategori;

		$category ->name_category = $namaKategori;
		$category ->save();

		return redirect()->route('merchantCategory')->with('success', 'Kategori berhasil ditambah');
	}

	public function update(Request $request, $id){
		$this->validate($request,[
			'kategori' => 'required|min:3'
		]);

		$category = Categories::where('id', $id)->first();
		$namaKategori = $request->kategori;

		$category ->name_category = $namaKategori;
		$category ->update();

		return redirect()->route('merchantCategory')->with('success', 'Kategori berhasil ditambah');
	}

	public function destroy($id)
    {
          $kategori = Categories::where('id', $id)->first();
          $kategori->delete();
          return redirect()->route('merchantCategory')->with('success', 'Data berhasil dihapus');
    }

}
