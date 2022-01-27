<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\mesin;
use Illuminate\Http\Request;

class operatormesincontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='mesin';
        $datas=mesin::with('kategori')
        ->with('gedung')
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.mesin.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='mesin';
        $datas=mesin::with('kategori')->with('gedung')
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.mesin.index',compact('datas','request','pages'));
    }
}
