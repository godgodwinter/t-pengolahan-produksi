@extends('layouts.default')

@section('title')
Mesin
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">


                        <form action="{{ route('operator.mesin.cari') }}" method="GET">
                            <div class="d-flex bd-highlight mb-3 align-items-center">

                                <div class="p-2 bd-highlight">
                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                                </div>

                                <div class="p-2 bd-highlight">
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                                </div>

                            <div class="ml-auto p-2 bd-highlight">
                        </form>

                    </div>
                </div>


                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> No</th>
                            <th >Nama</th>
                            <th>Gedung</th>
                            <th  class="text-center">Kategori</th>
                            <th class="text-center">Status</th>
                            <th  class="text-center">Monitoring Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">

                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    {{Str::limit($data->nama,25,' ...')}}
                                </td>
                                <td>{{$data->gedung?$data->gedung->nama.', Lantai ke-'.$data->gedung->lantai:'Data tidak ditemukan'}}</td>
                                <td  class="text-center">{{$data->kategori?$data->kategori->nama:'Data tidak ditemukan'}}</td>
                                @php
                                    $status='Baik';
                                    $warna='info';
                                    $jmlpelaporan=\App\Models\monitoringdetail::where('mesin_id',$data->id)->orderBy('created_at')->count();
                                    if($jmlpelaporan>0){
                                        $periksa=\App\Models\monitoringdetail::where('mesin_id',$data->id)->orderBy('created_at')->first();
                                        if($periksa->keterangan==='Rusak'){
                                            $status='Rusak';
                                            $warna='danger';
                                        }elseif($periksa->keterangan==='Hilang'){
                                            $status='Hilang';
                                            $warna='danger';
                                        }
                                    }


                                    $jmlkerusakan=\App\Models\pelaporankerusakandetail::where('mesin_id',$data->id)->orderBy('created_at')->count();

                                    $jmlperbaikan=\App\Models\maintenancedetail::where('mesin_id',$data->id)->orderBy('created_at')->count();

                                    if(($jmlkerusakan-$jmlperbaikan)>0){
                                            $status='Sedang Diperbaiki';
                                            $warna='success';
                                    }
                                    if(($jmlkerusakan-$jmlperbaikan)==0){
                                            $status='Baik';
                                            $warna='info';
                                    }
                                    if($jmlkerusakan!=0){

                                    if(($jmlkerusakan-$jmlperbaikan)==$jmlkerusakan){
                                            $status='Belum di perbaiki';
                                            $warna='warning';
                                    }
                                    }


                                    $lastmonitoring='-';
                                    $petugas='';
                                    $oleh='';
                                    $jmlmonitoring=\App\Models\monitoringdetail::where('mesin_id',$data->id)->orderBy('created_at')->count();
                                    if($jmlmonitoring>0){
                                    $getmonitoring=\App\Models\monitoringdetail::where('mesin_id',$data->id)->orderBy('created_at')->first();
                                    $lastmonitoring=$getmonitoring->monitoring?Fungsi::tanggalindo($getmonitoring->monitoring->tgl):'-';
                                    $petugas=$getmonitoring->monitoring?$getmonitoring->monitoring->users->name:'-';
                                    $oleh='-';
                                    }
                                @endphp
                                <td class="text-center"><button class="btn btn-sm btn-{{$warna}}">{{$status}}
                                    {{-- {{$jmlkerusakan}} / {{$jmlperbaikan}} --}}
                                </button></td>
                                <td class="text-center">{{$lastmonitoring}} {{$oleh}} {{$petugas}}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

@php
$cari=$request->cari;
$tapel_nama=$request->tapel_nama;
$kelas_nama=$request->kelas_nama;
@endphp

<div class="d-flex justify-content-between flex-row-reverse mt-3">
    <div >
{{ $datas->onEachSide(1)
  ->links() }}
    </div>
<div></div></div>
            </div>
        </div>
    </div>
</section>
@endsection
