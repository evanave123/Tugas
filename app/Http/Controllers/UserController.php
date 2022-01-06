<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $utama = \App\User::latest()->paginate(10);
        $data['utama'] = $utama;
        return view('user_index', $data);
    }

    public function tambah()
    {
        $data['utama'] = new \App\User();
        $data['action'] = 'UserController@simpan';
        $data['method'] = 'POST';
        $data['nama_tombol'] = 'SIMPAN';
        return view('user_form', $data);
    }

    public function simpan(Request $request)
    {
        
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:password_confirmation'
        ]);
        $utama = new \App\User();
        $utama->name = $request->name;
        $utama->email = $request->email; // <- email_box adalah kotak yang digunakan untuk mengisi email di form//
        $utama->password = bcrypt($request->password);
        $utama->save();
        /*\App\User::create($request->except('password_confirmation'));*/
        return back()->with('pesan', 'Data Sudah Tersimpan');

    }

    public function edit($id)
    {
        $data['utama'] = \App\User::findOrFail($id);
        $data['action'] = ['UserController@update', $id]; /*array*/
        $data['method'] = 'PUT';
        $data['nama_tombol'] = 'UPDATE';
        return view('user_form', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' .$id,
            'password' => 'same:password_confirmation'
        ]);
        $utama = \App\User::findOrFail($id);
        $utama->name = $request->name;
        $utama->email = $request->email; // <- email_box adalah kotak yang digunakan untuk mengisi email di form//
        if ($request->password != "")
        {
            $utama->password = bcrypt($request->password);
        }
        /*$utama->password = bcrypt($request->password);*/
        $utama->save();
        /*\App\User::create($request->except('password_confirmation'));*/
        return redirect('admin/user/index')->with('pesan', 'Data Sudah diUpdate');
    }

    public function hapus ($id)
    {
        $utama = \App\User::findOrFail($id);
        $utama->delete();
        return back()->with('pesan', 'Data berhasil diHapus');
    }
}
