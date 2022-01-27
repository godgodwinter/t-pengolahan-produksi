<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\mesin;
use App\Models\monitoring;
use App\Models\monitoringdetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class operatormonitoringcontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::with('users')->where('users_id',Auth::user()->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.monitoring.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::where('nama','like',"%".$cari."%")
        ->with('users')
        ->where('users_id',Auth::user()->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.monitoring.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='monitoring';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.operator.monitoring.create',compact('pages','users'));
    }

    public function store(Request $request)
    {

        // dd($request,Auth::user()->id);
            $request->validate([
                'tgl'=>'required',

            ],
            [
                'tgl.required'=>'tgl harus diisi',
            ]);

            $getid=DB::table('monitoring')->insertGetId(
                array(
                       'tgl'     =>   $request->tgl,
                       'users_id'     =>   Auth::user()->id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('operator.monitoring')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(monitoring $id)
    {
        $pages='monitoring';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.operator.monitoring.edit',compact('pages','id','users'));
    }
    public function update(monitoring $id,Request $request)
    {


        $request->validate([
            'tgl'=>'required',
        ],
        [
            'tgl.required'=>'name harus diisi',
        ]);


            monitoring::where('id',$id->id)
            ->update([
                'tgl'     =>   $request->tgl,
                'users_id'     =>   Auth::user()->id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('operator.monitoring')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(monitoring $id){

        monitoring::destroy($id->id);
        return redirect()->route('operator.monitoring')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
     public function detail(monitoring $id,Request $request)
    {
        // dd($id);
        $pages='monitoring';
        $datas=monitoringdetail::with('monitoring')->where('monitoring_id',$id->id)
        ->paginate(Fungsi::paginationjml());
        return view('pages.operator.monitoring.detail',compact('pages','id','datas','request'));

    }

    public function detailcreate(monitoring $id,Request $request)
    {
        // dd($id);
        $this->queryid=$id->id;
        $pages='monitoring';
        $mesin=mesin::whereNotIn('id',function($query){
                $query->select('mesin_id')->from('monitoringdetail')->where('monitoring_id',$this->queryid);
            })->get();
            // dd($mesin);
        return view('pages.operator.monitoring.detailcreate',compact('pages','id','mesin','request'));

    }
    public function detailstore(monitoring $id,Request $request)
    {

        // dd($request);
            $request->validate([
                'keterangan'=>'required',

            ],
            [
                'keterangan.required'=>'keterangan harus diisi',
            ]);

            $getid=DB::table('monitoringdetail')->insertGetId(
                array(
                        'monitoring_id'     =>   $id->id,
                       'mesin_id'     =>   $request->mesin_id,
                       'keterangan'     =>   $request->keterangan,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('operator.monitoring.detail',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }
    public function detaildestroy(monitoring $id,monitoringdetail $monitoringdetail){

        monitoringdetail::destroy($monitoringdetail->id);
        return redirect()->route('operator.monitoring.detail',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }

}
