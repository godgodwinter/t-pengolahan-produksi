@extends('layouts.default')

@section('title')
Bahan Produksi
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


                        <form action="{{ route('bahan.cari') }}" method="GET">
                            <div class="d-flex bd-highlight mb-3 align-items-center">

                                <div class="p-2 bd-highlight">
                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                                </div>

                                <div class="p-2 bd-highlight">
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                                </div>

                            <div class="ml-auto p-2 bd-highlight">
                                <x-button-create link="{{route('bahan.create')}}"></x-button-create>
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
                            <th  class="text-center">Aksi</th>
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

                                <td class="text-center babeng-min-row">
                                    <x-button-edit link="{{route('bahan.edit',$data->id)}}" />
                                    <x-button-delete link="{{route('bahan.destroy',$data->id)}}" />
                                </td>
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
