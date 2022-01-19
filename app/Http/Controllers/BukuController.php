<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $utama = \App\Buku::latest()->paginate(10);
        $data['utama'] = $utama;
        return view('buku_index', $data);
    }

    public function tambah()
    {
        $data['utama'] = new \App\Buku();
        $data['action'] = 'BukuController@simpan';
        $data['method'] = 'POST';
        $data['nama_tombol'] = 'SIMPAN';
        return view('buku_form', $data);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:2',
            'pengarang' => 'required|min:2',
        ]);
        $utama = new \App\Buku();
        $utama->judul = $request->judul;
        $utama->pengarang = $request->pengarang;
        $utama->save();
        
        return back()->with('pesan', 'Data Sudah Tersimpan');
    }

    public function edit($id)
    {
        $data['utama'] = \App\Buku::findOrFail($id);
        $data['action'] = ['BukuController@update', $id]; /*array*/
        $data['method'] = 'PUT';
        $data['nama_tombol'] = 'UPDATE';
        return view('Buku_form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:2',
            'pengarang' => 'required|min:2,' .$id,
        ]);
        $utama = \App\Buku::findOrFail($id);
        $utama->judul = $request->judul;
        $utama->pengarang = $request->pengarang; // <- pengarang(kanan) adalah kotak yang digunakan untuk mengisi pengarang di form//
        $utama->save();
        return redirect('admin/buku/index')->with('pesan', 'Data Sudah diUpdate');
    }

    public function hapus ($id)
    {
        $utama = \App\Buku::findOrFail($id);
        $utama->delete();
        return back()->with('pesan', 'Data berhasil diHapus');
    }

}
