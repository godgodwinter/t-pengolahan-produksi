<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminkategoricontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='kategori';
        $datas=kategori::paginate(Fungsi::paginationjml());

        return view('pages.admin.kategori.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='kategori';
        $datas=kategori::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.kategori.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='kategori';

        return view('pages.admin.kategori.create',compact('pages'));
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

            $getid=DB::table('kategori')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'prefix'     =>   'mesin',
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('kategori')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(kategori $id)
    {
        $pages='kategori';

        return view('pages.admin.kategori.edit',compact('pages','id'));
    }
    public function update(kategori $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            kategori::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                'prefix'     =>   'mesin',
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('kategori')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(kategori $id){

        kategori::destroy($id->id);
        return redirect()->route('kategori')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
