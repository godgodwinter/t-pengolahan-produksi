@extends('layouts.default')

@section('title')
Monitoring
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
            <div class="breadcrumb-item"><a href="{{route('monitoring')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">

                <form action="{{route('monitoring.update',$id->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row">

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="tgl">Tanggal monitoring <code>*)</code></label>
                            <input type="date" name="tgl" id="tgl" class="form-control @error('tgl') is-invalid @enderror" value="{{old('tgl')?old('tgl'):$id->tgl}}" required>
                            @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>


                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="users_id">Petugas <code>*)</code></label>

                                <select class="js-example-basic-single form-control-sm @error('users_id')
                                    is-invalid
                                @enderror" name="users_id"  style="width: 75%" >
                                <option  selected value="{{$id->users_id}}"> {{$id->users?$id->users->name:'Data tidak ditemukan'}}</option>
                                    @foreach ($users as $t)
                                        <option value="{{ $t->id }}"> {{ $t->name }}</option>
                                    @endforeach
                                  </select>

                              @error('kategori_id')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror

                          </div>



                    </div>

                    <div class="card-footer text-right mr-5">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>
@endsection
