<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\kategori;
use App\Models\petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminpetanicontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='petani';
        $datas=petani::with('kategori')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.petani.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='petani';
        $datas=DB::table('petani')
        ->where('nama','like',"%".$cari."%")
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.petani.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='petani';
        $kategori=kategori::get();
        // where('prefix','kelompoktani')->get();
        return view('pages.admin.petani.create',compact('pages','kategori'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $cek=DB::table('users')
        // ->where('username',$request->username)
        // ->orWhere('email',$request->email)
        // ->count();
        // // dd($cek);
        //     if($cek>0){
        //             $request->validate([
        //             'username'=>'required|unique:users,username',
        //             'email'=>'required|unique:users,email',
        //             'password' => 'min:3|required_with:password2|same:password2',
        //             'password2' => 'min:3',

        //             ],
        //             [
        //                 'username.unique'=>'username sudah digunakan',
        //             ]);

        //     }

        //     $request->validate([
        //         'name'=>'required',
        //         'username'=>'required',
        //         'password' => 'min:3|required_with:password2|same:password2',
        //         'password2' => 'min:3',

        //     ],
        //     [
        //         'nama.nama'=>'Nama harus diisi',
        //     ]);

            $getid=DB::table('petani')->insertGetId(
                array(
                       'nama'     =>   $request->nama,
                       'kategori_id'     =>   $request->kategori_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

                // dd($request,$getid);

    return redirect()->route('petani')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(petani $id)
    {
        $pages='petani';

        $kategori=kategori::get();
        // where('prefix','kelompoktani')->get();
        return view('pages.admin.petani.edit',compact('pages','id','kategori'));
    }
    public function update(petani $id,Request $request)
    {

        if($request->username!==$id->username){

            $request->validate([
                'nama' => "required",
            ],
            [
            ]);
        }

        $request->validate([
            'nama'=>'required',
            'kategori_id'=>'required',
        ],
        [
            'nama.required'=>'name harus diisi',
        ]);



            petani::where('id',$id->id)
            ->update([
                'nama'     =>   $request->nama,
                'kategori_id'     =>   $request->kategori_id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);



    return redirect()->route('petani')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(petani $id){

        petani::destroy($id->id);
        return redirect()->route('petani')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

}
