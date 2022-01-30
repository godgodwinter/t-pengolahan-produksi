<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminprodukcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='produk';
        $datas=produk::paginate(Fungsi::paginationjml());

        return view('pages.admin.produk.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='produk';
        $datas=produk::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.produk.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='produk';

        return view('pages.admin.produk.create',compact('pages'));
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

            $getid=DB::table('produk')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                    //    'stok'     =>   $request->stok,
                       'hargajual'     =>   $request->hargajual,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('produk')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(produk $id)
    {
        $pages='produk';

        return view('pages.admin.produk.edit',compact('pages','id'));
    }
    public function update(produk $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            produk::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                // 'stok'     =>   $request->stok,
                'hargajual'     =>   $request->hargajual,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('produk')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(produk $id){

        produk::destroy($id->id);
        return redirect()->route('produk')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
