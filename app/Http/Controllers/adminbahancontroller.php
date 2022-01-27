<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminbahancontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='bahan';
        $datas=bahan::paginate(Fungsi::paginationjml());

        return view('pages.admin.bahan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='bahan';
        $datas=bahan::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.bahan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='bahan';

        return view('pages.admin.bahan.create',compact('pages'));
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

            $getid=DB::table('bahan')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('bahan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(bahan $id)
    {
        $pages='bahan';

        return view('pages.admin.bahan.edit',compact('pages','id'));
    }
    public function update(bahan $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            bahan::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('bahan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(bahan $id){

        bahan::destroy($id->id);
        return redirect()->route('bahan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
