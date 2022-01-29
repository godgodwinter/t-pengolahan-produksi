<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\pengolahanbahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminpengolahanbahancontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='pengolahanbahan';
        $datas=pengolahanbahan::paginate(Fungsi::paginationjml());

        return view('pages.admin.pengolahanbahan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pengolahanbahan';
        $datas=pengolahanbahan::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.pengolahanbahan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='pengolahanbahan';

        return view('pages.admin.pengolahanbahan.create',compact('pages'));
    }

    public function store(Request $request)
    {

        // dd($request);
            $request->validate([
                'nama'=>'required',

            ],
            [
                'nama.nama'=>'Nama harus diisi',
            ]);

            $getid=DB::table('pengolahanbahan')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'stok'     =>   $request->stok,
                       'hargajual'     =>   $request->hargajual,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('pengolahanbahan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(pengolahanbahan $id)
    {
        $pages='pengolahanbahan';

        return view('pages.admin.pengolahanbahan.edit',compact('pages','id'));
    }
    public function update(pengolahanbahan $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            pengolahanbahan::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                'stok'     =>   $request->stok,
                'hargajual'     =>   $request->hargajual,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('pengolahanbahan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(pengolahanbahan $id){

        pengolahanbahan::destroy($id->id);
        return redirect()->route('pengolahanbahan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
