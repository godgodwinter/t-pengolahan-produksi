<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admingedungcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='gedung';
        $datas=gedung::paginate(Fungsi::paginationjml());

        return view('pages.admin.gedung.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='gedung';
        $datas=gedung::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.gedung.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='gedung';

        return view('pages.admin.gedung.create',compact('pages'));
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

            $getid=DB::table('gedung')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'lantai'     =>   $request->lantai,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('gedung')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(gedung $id)
    {
        $pages='gedung';

        return view('pages.admin.gedung.edit',compact('pages','id'));
    }
    public function update(gedung $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            gedung::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                'lantai'     =>   $request->lantai,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('gedung')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(gedung $id){

        gedung::destroy($id->id);
        return redirect()->route('gedung')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
