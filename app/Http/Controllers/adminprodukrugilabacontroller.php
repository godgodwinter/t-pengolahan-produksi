<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\produkrugilaba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminprodukrugilabacontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='produkrugilaba';
        $datas=produkrugilaba::paginate(Fungsi::paginationjml());

        return view('pages.admin.produkrugilaba.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='produkrugilaba';
        $datas=produkrugilaba::where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.produkrugilaba.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='produkrugilaba';

        return view('pages.admin.produkrugilaba.create',compact('pages'));
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

            $getid=DB::table('produkrugilaba')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('produkrugilaba')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(produkrugilaba $id)
    {
        $pages='produkrugilaba';

        return view('pages.admin.produkrugilaba.edit',compact('pages','id'));
    }
    public function update(produkrugilaba $id,Request $request)
    {


        $request->validate([
            'nama'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);


            produkrugilaba::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('produkrugilaba')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(produkrugilaba $id){

        produkrugilaba::destroy($id->id);
        return redirect()->route('produkrugilaba')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
