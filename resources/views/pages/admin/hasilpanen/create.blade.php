@extends('layouts.default')

@section('title')
Hasil Panen
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
            <div class="breadcrumb-item"><a href="{{route('hasilpanen')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('hasilpanen.store')}}" method="post">
                    @csrf

                    <div class="row">
                        @push('before-script')
                        <script type="text/javascript">
                            $(document).ready(function() {

                                // In your Javascript (external .js resource or <script> tag)
                                    $(document).ready(function() {
                                        $('.js-example-basic-single').select2({
                                            // theme: "classic",
                                            // allowClear: true,
                                            width: "resolve"
                                        });
                                    });
                            });
                           </script>
                        @endpush
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="nama">Bahan <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('bahan_id')
                                  is-invalid
                              @enderror" name="bahan_id"  style="width: 100%" >
                                  <option disabled selected value=""> Pilih Bahan Produksi</option>
                                  @foreach ($bahan as $t)
                                      <option value="{{ $t->id }}"> {{ $t->nama }}</option>
                                  @endforeach
                                </select>

                            @error('bahan_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>

                          <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="tgl_pelaporan">Tanggal Pelaporan <code>*)</code></label>
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker @error('tgl_pelaporan' )
                                is_invalid
                            @enderror" value="{{old('tgl_pelaporan')?old('tgl_pelaporan'):date('Y-m-d')}}" name="tgl_pelaporan">
                                    @error('tgl_pelaporan')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                        </div>



                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="nama">Petani <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('petani_id')
                                  is-invalid
                              @enderror" name="petani_id"  style="width: 100%" >
                                  <option disabled selected value=""> Pilih Petani</option>
                                  @foreach ($petani as $t)
                                      <option value="{{ $t->id }}"> {{ $t->name }}</option>
                                  @endforeach
                                </select>

                            @error('petani_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>

                          <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="waktu_panen">Waktu Panen <code>*)</code></label>
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker @error('waktu_panen' )
                                is_invalid
                            @enderror" value="{{old('waktu_panen')?old('waktu_panen'):date('Y-m-d')}}" name="waktu_panen">
                                    @error('waktu_panen')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                        </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jml">Jumlah <code>*)</code></label>
                        <input type="text" name="jml" id="jml" class="form-control @error('jml') is-invalid @enderror" value="{{old('jml')}}" required>
                        @error('jml')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="nama">Kualitas <code>*)</code></label>

                          <select class="js-example-basic-single form-control-sm @error('kualitas')
                              is-invalid
                          @enderror" name="kualitas"  style="width: 100%" >
                              <option disabled selected value=""> Pilih Kualitas</option>
                              <option>Sangat Baik</option>
                              <option>Baik</option>
                              <option>Cukup</option>
                              <option>Buruk</option>
                              <option>Sangat Buruk</option>
                            </select>

                        @error('kualitas')<div class="invalid-feedback"> {{$message}}</div>
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
