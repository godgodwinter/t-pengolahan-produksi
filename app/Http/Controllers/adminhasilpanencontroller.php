<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\bahan;
use App\Models\hasilpanen;
use App\Models\petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminhasilpanencontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='hasilpanen';
        $datas=hasilpanen::paginate(Fungsi::paginationjml());

        return view('pages.admin.hasilpanen.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='hasilpanen';
        $datas=hasilpanen::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.hasilpanen.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='hasilpanen';
        $bahan=bahan::get();
        $petani=User::where('tipeuser','petani')->get();

        return view('pages.admin.hasilpanen.create',compact('pages','bahan','petani'));
    }

    public function store(Request $request)
    {

        // dd($request);
            $request->validate([
                'bahan_id'=>'required',

            ],
            [
                'bahan_id.required'=>'Nama harus diisi',
            ]);

            $getid=DB::table('hasilpanen')->insertGetId(
                array(
                       'bahan_id'     =>   $request->bahan_id,
                       'tgl_pelaporan'     =>   $request->tgl_pelaporan,
                       'petani_id'     =>   $request->petani_id,
                       'waktu_panen'     =>   $request->waktu_panen,
                       'jml'     =>   $request->jml,
                       'kualitas'     =>   $request->kualitas,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('hasilpanen')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(hasilpanen $id)
    {
        $pages='hasilpanen';

        return view('pages.admin.hasilpanen.edit',compact('pages','id'));
    }
    public function update(hasilpanen $id,Request $request)
    {


        $request->validate([
            'bahan_id'=>'required',
        ],
        [
            'bahan_id.required'=>'name harus diisi',
        ]);


            hasilpanen::where('id',$id->id)
            ->update([
                'bahan_id'     =>   $request->bahan_id,
                'tgl_pelaporan'     =>   $request->tgl_pelaporan,
                'petani_id'     =>   $request->petani_id,
                'waktu_panen'     =>   $request->waktu_panen,
                'jml'     =>   $request->jml,
                'kualitas'     =>   $request->kualitas,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('hasilpanen')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(hasilpanen $id){

        hasilpanen::destroy($id->id);
        return redirect()->route('hasilpanen')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
