<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda');
    }
}
