@extends('layouts.default')

@section('title')
Rekap Penjualan
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
            <div class="breadcrumb-item"><a href="{{route('penjualan')}}">@yield('title')</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h5>Edit</h5>
            </div>
            <div class="card-body">

                <form action="{{route('penjualan.update',$id->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row">

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="tgl">Tanggal<code>*)</code></label>
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker @error('tgl' )
                                is_invalid
                            @enderror" value="{{old('tgl')?old('tgl'):$id->tgl}}" name="tgl">
                                    @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                        </div>

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
                            <label for="produk_id">Produk <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('produk_id')
                                  is-invalid
                              @enderror" name="produk_id"  style="width: 100%" >
                                  <option  selected value="{{$id->produk_id}}">{{$id->produk?$id->produk->nama:'Data tidak ditemukan'}}</option>
                                  @foreach ($produk as $t)
                                      <option value="{{ $t->id }}"> {{ $t->nama }} </option>
                                  @endforeach
                                </select>

                            @error('produk_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jml_produk_diolah_perbulan">Jumlah Produk diolah Perbulan<code>*)</code></label>
                        <input type="number" min="0" name="jml_produk_diolah_perbulan" id="jml_produk_diolah_perbulan" class="form-control @error('jml_produk_diolah_perbulan') is-invalid @enderror" value="{{old('jml_produk_diolah_perbulan')?old('jml_produk_diolah_perbulan'):$id->jml_produk_diolah_perbulan}}" required>
                        @error('jml_produk_diolah_perbulan')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jml_produk_terjual_perbulan">Jumlah Produk terjual Perbulan<code>*)</code></label>
                        <input type="number" min="0" name="jml_produk_terjual_perbulan" id="jml_produk_terjual_perbulan" class="form-control @error('jml_produk_terjual_perbulan') is-invalid @enderror" value="{{old('jml_produk_terjual_perbulan')?old('jml_produk_terjual_perbulan'):$id->jml_produk_terjual_perbulan}}" required>
                        @error('jml_produk_terjual_perbulan')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group col-md-5 col-5 mt-0 ml-5">
                        <label for="jml_rugilaba">Jumlah Rugi/Laba<code>*)</code></label>
                        <input type="number" min="0" name="jml_rugilaba" id="jml_rugilaba" class="form-control @error('jml_rugilaba') is-invalid @enderror" value="{{old('jml_rugilaba')?old('jml_rugilaba'):$id->jml_rugilaba}}" required>
                        @error('jml_rugilaba')<div class="invalid-feedback"> {{$message}}</div>
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
