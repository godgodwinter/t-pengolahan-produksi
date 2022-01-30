@extends('layouts.default')

@section('title')
Rekap Rugi/Laba
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


                        <form action="{{ route('produkrugilaba.cari') }}" method="GET">
                            <div class="d-flex bd-highlight mb-3 align-items-center">

                                <div class="p-2 bd-highlight">
                            {{-- <input type="text" class="babeng babeng-select  ml-0" name="cari"> --}}
                                </div>

                                <div class="p-2 bd-highlight">
                                {{-- <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari"> --}}
                                </div>

                            <div class="ml-auto p-2 bd-highlight">
                                {{-- <x-button-create link="{{route('produkrugilaba.create')}}"></x-button-create> --}}
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
                            <th >Nama Produk</th>
                            <th  class="text-center">Jumlah di produksi per bulan</th>
                            <th class="text-center">Jumlah terjual per bulan</th>
                            <th class="text-center">Jumlah Rugi/Laba (Masih tersedia)</th>
                            {{-- <th  class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">

                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                   {{$data->nama}}
                                </td>
                                <td class="text-center">
                                    @php
                                        $jml_produk_diolah_perbulan=0;
                                        $jml_produk_diolah_perbulan=\App\Models\pengolahanbahan::where('produk_id',$data->id)
                                        ->whereMonth('waktupengolahan', '=', date('m'))
                                        ->sum('jml');
                                    @endphp
                                    {{$jml_produk_diolah_perbulan}} ({{Fungsi::rupiah($jml_produk_diolah_perbulan*$data->hargajual)}})
                                </td>
                                <td class="text-center">
                                    @php
                                        $jml_produk_terjual_perbulan=0;
                                        $jml_produk_terjual_perbulan=\App\Models\produkrugilaba::where('produk_id',$data->id)
                                        ->whereMonth('tgl', '=', date('m'))
                                        ->sum('jml_terjual');
                                    @endphp
                                    {{$jml_produk_terjual_perbulan}} ({{Fungsi::rupiah($jml_produk_terjual_perbulan*$data->hargajual)}})
                                </td>
                                <td class="text-center">
                                    @php
                                        $jml_rugilaba=0;
                                        $jml_rugilaba=$jml_produk_diolah_perbulan-$jml_produk_terjual_perbulan;
                                    @endphp
                                    {{$jml_rugilaba}} ({{Fungsi::rupiah($jml_rugilaba*$data->hargajual)}})
                                </td>

                                {{-- <td class="text-center babeng-min-row">
                                    <x-button-edit link="{{route('produkrugilaba.edit',$data->id)}}" />
                                    <x-button-delete link="{{route('produkrugilaba.destroy',$data->id)}}" />
                                </td> --}}
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
