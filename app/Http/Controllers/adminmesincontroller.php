<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\gedung;
use App\Models\kategori;
use App\Models\mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminmesincontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='mesin';
        $datas=mesin::with('kategori')
        ->with('gedung')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.mesin.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='mesin';
        $datas=mesin::with('kategori')->with('gedung')
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.mesin.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='mesin';
        $kategori=kategori::where('prefix','mesin')->get();
        $gedung=gedung::get();
        return view('pages.admin.mesin.create',compact('pages','kategori','gedung'));
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

            $getid=DB::table('mesin')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'kategori_id'     =>   $request->kategori_id,
                       'gedung_id'     =>   $request->gedung_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('mesin')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(mesin $id)
    {
        $pages='mesin';
        $kategori=kategori::where('prefix','mesin')->get();
        $gedung=gedung::get();

        return view('pages.admin.mesin.edit',compact('pages','id','kategori','gedung'));
    }
    public function update(mesin $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            mesin::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                'kategori_id'     =>   $request->kategori_id,
                'gedung_id'     =>   $request->gedung_id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('mesin')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(mesin $id){

        mesin::destroy($id->id);
        return redirect()->route('mesin')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
