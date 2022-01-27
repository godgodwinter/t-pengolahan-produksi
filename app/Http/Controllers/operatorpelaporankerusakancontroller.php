<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\monitoringdetail;
use App\Models\pelaporankerusakan;
use App\Models\pelaporankerusakandetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class operatorpelaporankerusakancontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::with('users')->where('users_id',Auth::user()->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::where('nama','like',"%".$cari."%")->where('users_id',Auth::user()->id)
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='pelaporankerusakan';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.operator.pelaporankerusakan.create',compact('pages','users'));
    }

    public function store(Request $request)
    {

        // dd($request);
            $request->validate([
                'tgl'=>'required',

            ],
            [
                'tgl.required'=>'tgl harus diisi',
            ]);

            $getid=DB::table('pelaporankerusakan')->insertGetId(
                array(
                       'tgl'     =>   $request->tgl,
                       'users_id'     =>   Auth::user()->id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('operator.pelaporankerusakan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(pelaporankerusakan $id)
    {
        $pages='pelaporankerusakan';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.operator.pelaporankerusakan.edit',compact('pages','id','users'));
    }
    public function update(pelaporankerusakan $id,Request $request)
    {


        $request->validate([
            'tgl'=>'required',
        ],
        [
            'tgl.required'=>'name harus diisi',
        ]);


            pelaporankerusakan::where('id',$id->id)
            ->update([
                'tgl'     =>   $request->tgl,
                'users_id'     =>   Auth::user()->id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('operator.pelaporankerusakan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(pelaporankerusakan $id){

        pelaporankerusakan::destroy($id->id);
        return redirect()->route('operator.pelaporankerusakan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function detail(pelaporankerusakan $id,Request $request)
   {
       // dd($id);
       $pages='pelaporankerusakan';
       $datas=pelaporankerusakandetail::with('pelaporankerusakan')->where('pelaporankerusakan_id',$id->id)
       ->paginate(Fungsi::paginationjml());
       return view('pages.operator.pelaporankerusakan.detail',compact('pages','id','datas','request'));

   }

   public function detailcreate(pelaporankerusakan $id,Request $request)
   {
       // dd($id);
       $pages='pelaporankerusakan';
       $mesin=monitoringdetail::with('mesin')->where('keterangan','Rusak')->get();

    //    $this->queryid=$id->id;
    //    $pages='monitoring';
    //    $mesin=monitoringdetail::whereNotIn('id',function($query){
    //            $query->select('mesin_id')->from('monitoringdetail')->where('monitoring_id',$this->queryid);
    //        })->get();
       return view('pages.operator.pelaporankerusakan.detailcreate',compact('pages','id','mesin','request'));

   }
   public function detailstore(pelaporankerusakan $id,Request $request)
   {

       // dd($request);
           $request->validate([
               'keterangan'=>'required',

           ],
           [
               'keterangan.required'=>'keterangan harus diisi',
           ]);

           $getid=DB::table('pelaporankerusakandetail')->insertGetId(
               array(
                       'pelaporankerusakan_id'     =>   $id->id,
                      'mesin_id'     =>   $request->mesin_id,
                      'keterangan'     =>   $request->keterangan,
                      'created_at'=>date("Y-m-d H:i:s"),
                      'updated_at'=>date("Y-m-d H:i:s")
               ));

   return redirect()->route('operator.pelaporankerusakan.detail',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

   }
   public function detaildestroy(pelaporankerusakan $id,pelaporankerusakandetail $pelaporankerusakandetail){

       pelaporankerusakandetail::destroy($pelaporankerusakandetail->id);
       return redirect()->route('operator.pelaporankerusakan.detail',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

   }
}
