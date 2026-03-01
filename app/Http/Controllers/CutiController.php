<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use Inertia\Inertia;

class CutiController extends Controller
{
    public function index(){
        $cutis = Cuti::latest()->get();
        return Inertia::render('Cutis/Index', [
            'cutis' => $cutis
        ]);
    }

    // show form to create new cuti
    public function tambah()
    {
        return Inertia::render('Cutis/Tambah');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after_or_equal:tarikh_mula',
            'jenis_cuti' => 'required',
        ]);

        Cuti::create([
            'nama' => $validated['nama'],
            'tarikh_mula' => $validated['tarikh_mula'],
            'tarikh_tamat' => $validated['tarikh_tamat'],
            'jenis_cuti' => $validated['jenis_cuti'],
        ]); // Simpan data ke database
        
        return redirect('/cutis')->with('success', 'Cuti berjaya ditambah!');
    }

    public function update(Request $request, Cuti $cuti){
        // cam biasa request untuk validate
        // $cuti ni dia guna untuk identify id cuti.
        // so bila kita buat route /cutis/{cuti}/update, 
        // dia akan automatik cari cuti dengan id yang sama dengan {cuti} tu, 
        // then dia akan pass data cuti tu ke function update ni. 

        $validated = $request->validate([
            'nama' => 'required',
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date|after_or_equal:tarikh_mula',
            'jenis_cuti' => 'required',
        ]);

        $cuti->update([
            'nama' => $validated['nama'],
            'tarikh_mula' => $validated['tarikh_mula'],
            'tarikh_tamat' => $validated['tarikh_tamat'],
            'jenis_cuti' => $validated['jenis_cuti'],
        ]);
        return redirect('/cutis')->with('success', 'Cuti berjaya dikemaskini!');
    }

    public function destroy(Cuti $cuti){
        $cuti->delete();
        return redirect('/cutis')->with('success', 'Cuti berjaya dihapus!');
    }
    
}
