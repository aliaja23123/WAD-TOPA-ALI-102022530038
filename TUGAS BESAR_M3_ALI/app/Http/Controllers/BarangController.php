<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    
    public function index()
    {
        $barangs = Barang::all();
        $totalBarang = $barangs->count();
        $totalElektronik = $barangs->where('kategori', 'Elektronik')->count();
        $totalPerkakas = $barangs->where('kategori', 'Perkakas')->count();

        return view('katalog', compact('barangs', 'totalBarang', 'totalElektronik', 'totalPerkakas'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
           
            'kodeBarang' => 'required|unique:barang,sku', 
            'namaBarang' => 'required',
            'kategoriBarang' => 'required',
            'satuanUnit' => 'required',
        ]);

        Barang::create([
            'sku' => $request->kodeBarang,
            'nama_barang' => $request->namaBarang,
            'kategori' => $request->kategoriBarang,
            'satuan' => $request->satuanUnit,
        ]);

        return redirect()->route('katalog.index');
    }

    
    public function edit($sku)
    {
        $barang = Barang::findOrFail($sku); 
        return view('edit', compact('barang'));
    }

   
    public function update(Request $request, $sku)
    {
        $request->validate([
            'namaBarang' => 'required',
            'kategoriBarang' => 'required',
            'satuanUnit' => 'required',
        ]);

        $barang = Barang::findOrFail($sku);
        
        $barang->update([
            'nama_barang' => $request->namaBarang,
            'kategori' => $request->kategoriBarang,
            'satuan' => $request->satuanUnit,
        ]);

        return redirect()->route('katalog.index');
    }

   
    public function destroy($sku)
    {
        $barang = Barang::findOrFail($sku);
        $barang->delete();
        
        return redirect()->route('katalog.index');
    }
}