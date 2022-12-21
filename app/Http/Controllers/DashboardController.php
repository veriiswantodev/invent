<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tempat;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $barang = Barang::all();
        $tempat = Tempat::all();
        return view('dashboard.index', compact('user', 'tempat', 'barang'));
    }
}
