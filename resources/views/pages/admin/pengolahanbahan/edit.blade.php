@extends('layouts.default')

@section('title')
Pengolahanbahan
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
            <div class="breadcrumb-item"><a href="{{route('pengolahanbahan')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">

                <form action="{{route('pengolahanbahan.update',$id->id)}}" method="post">
                    @method('put')
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
                            <label for="hasilpanen_id">Hasil Panen <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('hasilpanen_id')
                                  is-invalid
                              @enderror" name="hasilpanen_id"  style="width: 100%" >
                                  <option  selected value="{{ $id->hasilpanen_id }}"> {{$id->hasilpanen?Fungsi::tanggalindo($id->hasilpanen->waktu_panen):'Data tidak ditemukan'}} -  {{ $id->hasilpanen?$id->hasilpanen->bahan->nama:'Data tidak ditemukan' }} - {{$id->hasilpanen?$id->hasilpanen->petani->nama:'Data tidak ditemukan'}}</option>
                                  @foreach ($hasilpanen as $t)
                                      <option value="{{ $t->id }}"> {{Fungsi::tanggalindo($t->waktu_panen)}} -  {{ $t->bahan?$t->bahan->nama:'Data tidak ditemukan' }} - {{$t->petani?$t->petani->nama:'Data tidak ditemukan'}}</option>
                                  @endforeach
                                </select>

                            @error('hasilpanen_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>


                          <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="waktupengolahan">Waktu Pengolahan <code>*)</code></label>
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker @error('waktupengolahan' )
                                is_invalid
                            @enderror" value="{{old('waktupengolahan')?old('waktupengolahan'):$id->waktupengolahan}}" name="waktupengolahan">
                                    @error('waktupengolahan')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="jml_pengolahan">Jumlah Pengolahan<code>*)</code></label>
                            <input type="text" name="jml_pengolahan" id="jml_pengolahan" class="form-control @error('jml_pengolahan') is-invalid @enderror" value="{{old('jml_pengolahan')?old('jml_pengolahan'):$id->jml_pengolahan}}" required>
                            @error('jml_pengolahan')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="hasil_pengolahan">Hasil Pengolahan<code>*)</code></label>
                            <input type="text" name="hasil_pengolahan" id="hasil_pengolahan" class="form-control @error('hasil_pengolahan') is-invalid @enderror" value="{{old('hasil_pengolahan')?old('hasil_pengolahan'):$id->hasil_pengolahan}}" required>
                            @error('hasil_pengolahan')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="nama">Produk <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('produk_id')
                                  is-invalid
                              @enderror" name="produk_id"  style="width: 100%" >
                                  <option disabled  value="{{$id->produk_id}}">{{$id->produk?$id->produk->nama:'Data tidak ditemukan'}}</option>
                                  @foreach ($produk as $t)
                                      <option value="{{ $t->id }}"> {{$t->nama}}</option>
                                  @endforeach
                                </select>

                            @error('produk_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="jml">Jumlah <code>*)</code></label>
                            <input type="number" min="1" name="jml" id="jml" class="form-control @error('jml') is-invalid @enderror" value="{{old('jml')?old('jml'):$id->jml}}" required>
                            @error('jml')<div class="invalid-feedback"> {{$message}}</div>
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
