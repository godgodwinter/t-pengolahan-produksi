@extends('layouts.default')

@section('title')
Petani
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
            <div class="breadcrumb-item"><a href="{{route('petani')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('petani.store')}}" method="post">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Nama Lengkap <code>*)</code></label>
                        <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>
                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="kategori_id">Kelompok tani <code></code></label>
                            <select class="js-example-basic-single form-control-sm @error('kategori_id')
                                is-invalid
                            @enderror" name="kategori_id"  style="width: 75%" >
                                <option disabled selected value=""> Pilih Kelompok Tani</option>
                                @forelse ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @empty

                                @endforelse
                              </select>

                          @error('kategori_id')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div>

                    {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="username">Username<code></code></label>

                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" required  value="{{old('username')}}">

                        @error('username')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="email">Email<code></code></label>

                        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" required  value="{{old('email')}}">

                        @error('email')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div> --}}

                    {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="email">Hak Akses <code></code></label>
                            <select class="js-example-basic-single form-control-sm @error('tipeuser')
                                is-invalid
                            @enderror" name="tipeuser"  style="width: 75%" >
                                <option disabled selected value=""> Pilih Hak Akses</option>
                                <option value="petani">petani</option>
                              </select>

                          @error('tipeuser')<div class="invalid-feedback"> {{$message}}</div>
                          @enderror

                      </div> --}}

                    {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="password">Password<code></code></label>


                        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required>

                        @error('password')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="password">Konfirmasi Password<code></code></label>


                        <input type="password" class="form-control  @error('password2') is-invalid @enderror" name="password2" required>

                        @error('password2')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div> --}}




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
