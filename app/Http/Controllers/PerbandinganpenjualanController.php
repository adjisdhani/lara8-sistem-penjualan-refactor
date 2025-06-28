<?php

namespace App\Http\Controllers;

use App\Models\Jpenjualan;
use Illuminate\Http\Request;

class PerbandinganpenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jpenjualanpilihan1 = Jpenjualan::where('id', request(['search1']))->get();
        $jpenjualanpilihan2 = Jpenjualan::where('id', request(['search2']))->get();

        $jpenjualan = Jpenjualan::all();
        $active = "perbandingan_penjualan";
        return view('Perbandinganjenispenjualan.index', compact('active', 'jpenjualan', 'jpenjualanpilihan1', 'jpenjualanpilihan2'));
    }
}