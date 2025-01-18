<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\PaketMember;

class PaketController extends Controller
{
    public function index(){
        $paketMember = PaketMember::all();
        return view('admin.paket-gym', compact('paketMember'));
    }

    public function add(){
        return view('admin.tambah-paket-gym');
    }

    public function create(Request $request){
        $validated = $request->validate([
            'nama_paket' => 'required|max:150',
            'keterangan_durasi' => 'required',
            'keterangan_fasilitas' => 'required',
            'keterangan-private' => 'nullable',
            'harga' => 'required|numeric',
        ]);
    
        try {
            // Cara 1: Menggunakan DB::statement
            DB::statement('CALL tambah_paket(?,?,?,?,?,?)', [
                $validated['nama_paket'],
                $validated['keterangan_fasilitas'],
                $validated['keterangan_durasi'],
                $validated['harga'],
                $validated['keterangan-private'],
                1
                // auth()->user()->id,
            ]);

            return redirect('/admin/paket-member')->with('success', 'Paket gym berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update($id){
        $detailPaket = PaketMember::where('id_paket', $id)->first();
        return view('admin.edit-paket-gym', compact('detailPaket'));
    }

    public function edit(Request $request){
        $validated = $request->validate([
            'id_paket' => 'required|integer|exists:paket_member,id_paket',
            'nama_paket' => 'required|max:150',
            'keterangan_durasi' => 'required',
            'keterangan_fasilitas' => 'required',
            'keterangan_private' => 'nullable',
            'harga' => 'required|numeric',
        ]);
    
        try {
            // Cara 1: Menggunakan DB::statement
            DB::statement('CALL edit_paket_member(?,?,?,?,?,?,?)', [
                $validated['id_paket'],
                $validated['nama_paket'],
                $validated['keterangan_fasilitas'],
                $validated['keterangan_durasi'],
                $validated['harga'],
                $validated['keterangan_private'],
                1
            ]);

            return redirect('/admin/paket-member')->with('success', 'Paket gym berhasil diubah.');  
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id){
        $paketMember = PaketMember::findOrFail($id);
        $paketMember->delete();

        return redirect('/admin/paket-member')->with('success', 'Paket gym berhasil dihapus.');
    }
}
