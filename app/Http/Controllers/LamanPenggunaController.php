<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LamanPenggunaController extends Controller
{
    public function index()
    {
        return view('LamanPengguna'); // Merender file LamanPengguna.blade.php
    }
}
