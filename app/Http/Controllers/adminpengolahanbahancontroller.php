<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\hasilpanen;
use App\Models\pengolahanbahan;
use App\Models\produk;
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
        $hasilpanen=hasilpanen::with('bahan')->with('petani')->orderBy('tgl_pelaporan')->get();
        $produk=produk::get();
        return view('pages.admin.pengolahanbahan.create',compact('pages','hasilpanen','produk'));
    }

    public function store(Request $request)
    {

        // dd($request);
            $request->validate([
                'hasilpanen_id'=>'required',

            ],
            [
                'hasilpanen_id.require'=>'hasilpanen harus diisi',
            ]);

            $getid=DB::table('pengolahanbahan')->insertGetId(
                array(
                       'hasilpanen_id'     =>   $request->hasilpanen_id,
                       'waktupengolahan'     =>   $request->waktupengolahan,
                       'jml_pengolahan'     =>   $request->jml_pengolahan,
                       'hasil_pengolahan'     =>   $request->hasil_pengolahan,
                       'produk_id'     =>   $request->produk_id,
                       'jml'     =>   $request->jml,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('pengolahanbahan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(pengolahanbahan $id)
    {
        $pages='pengolahanbahan';

        $hasilpanen=hasilpanen::with('bahan')->with('petani')->orderBy('tgl_pelaporan')->get();
        $produk=produk::get();
        return view('pages.admin.pengolahanbahan.edit',compact('pages','id','hasilpanen','produk'));
    }
    public function update(pengolahanbahan $id,Request $request)
    {


        $request->validate([
            'hasilpanen_id'=>'required',
        ],
        [
            'hasilpanen_id.required'=>'hasilpanen_id harus diisi',
        ]);


            pengolahanbahan::where('id',$id->id)
            ->update([
                'hasilpanen_id'     =>   $request->hasilpanen_id,
                'waktupengolahan'     =>   $request->waktupengolahan,
                'jml_pengolahan'     =>   $request->jml_pengolahan,
                'hasil_pengolahan'     =>   $request->hasil_pengolahan,
                'produk_id'     =>   $request->produk_id,
                'jml'     =>   $request->jml,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('pengolahanbahan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(pengolahanbahan $id){

        pengolahanbahan::destroy($id->id);
        return redirect()->route('pengolahanbahan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
