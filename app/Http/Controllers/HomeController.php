<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $datas = DB::table('rental')
                ->join('customer', 'customer.id_customer', '=', 'rental.id_customer')
                ->join('mobil', 'mobil.id_mobil', '=', 'rental.id_mobil')
                ->join('sopir', 'sopir.id_sopir', '=', 'rental.id_sopir')
                ->get();

        return view('home.index')
            ->with('datas', $datas);
    }
}