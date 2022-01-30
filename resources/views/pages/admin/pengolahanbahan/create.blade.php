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
                <h5>Tambah</h5>
            </div>
            <div class="card-body">

                <form action="{{route('pengolahanbahan.store')}}" method="post">
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
                              @enderror" name="hasilpanen_id"  style="width: 100%"  id="hasilpanen">
                                  <option disabled selected value=""> Pilih Hasil Panen</option>
                                  @foreach ($hasilpanen as $t)
                                      <option value="{{ $t->id }}"> {{Fungsi::tanggalindo($t->waktu_panen)}} -  {{ $t->bahan?$t->bahan->nama:'Data tidak ditemukan' }} - {{$t->petani?$t->petani->name:'Data tidak ditemukan'}}</option>
                                  @endforeach
                                </select>

                            @error('hasilpanen_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>
                          @push('before-script')
                          <script>
                              $(function () {
                                  //createobjechasilpanen
                                  const datahasilpanen=[];
                                    let hasilpanen={};

                                    // hasilpanen={
                                    //     id:1,
                                    //     nama:"Petani",
                                    //     jml:20
                                    // };
                                    // datahasilpanen.push(hasilpanen);
                                    // hasilpanen={
                                    //     id:2,
                                    //     nama:"Petani2",
                                    //     jml:22
                                    // };
                                    // datahasilpanen.push(hasilpanen);

                                    // var item = datahasilpanen.find(item => item.id === 2);
                                    // console.log(item.jml);

                                    @forelse ($hasilpanen as $item)
                                    hasilpanen={
                                        id:{{$item->id}},
                                        // nama:{{$item->id}},
                                        @php
                                        $gettelahdiolah=\App\Models\pengolahanbahan::where('hasilpanen_id',$item->id)->sum('jml_pengolahan');

                                        @endphp
                                        jml:"{{$item->jml-$gettelahdiolah}}"
                                    };
                                    datahasilpanen.push(hasilpanen);

                                    // console.log(datahasilpanen);
                                    @empty

                                    @endforelse


                                    // var item = datahasilpanen.find(item => item.id === 1);
                                    // console.log(item.jml);;
                                    console.log(datahasilpanen);

                                    function getjml(id){
                                        let jml=0;
                                        let item = datahasilpanen.find(item => item.id == id);
                                        jml=item.jml;
                                        return jml;
                                    }
                                    $('#hasilpanen').change(function (e) {
                                        // console.log($('#hasilpanen').val());
                                        let jml=getjml($('#hasilpanen').val());
                                        // console.log(jml);
                                        $('#jmltersedia').text(jml);
                                    });
                                });
                            </script>
                          @endpush

                          <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="waktupengolahan">Waktu Pengolahan <code>*)</code></label>
                                <div class="form-group">
                                    <input type="date" class="form-control datepicker @error('waktupengolahan' )
                                is_invalid
                            @enderror" value="{{old('waktupengolahan')?old('waktupengolahan'):date('Y-m-d')}}" name="waktupengolahan">
                                    @error('waktupengolahan')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            @php
                                $jmltersedia=0;
                            @endphp
                            <label for="jml_pengolahan">Jumlah Di olah<code>*) tersedia : </code></label><code><label id="jmltersedia">{{$jmltersedia}}</label></code>
                            <input type="number" min="1" name="jml_pengolahan" id="jml_pengolahan" class="form-control @error('jml_pengolahan') is-invalid @enderror" value="{{old('jml_pengolahan')}}" required>
                            @error('jml_pengolahan')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="hasil_pengolahan">Hasil Pengolahan<code>*)</code></label>
                            <input type="text" name="hasil_pengolahan" id="hasil_pengolahan" class="form-control @error('hasil_pengolahan') is-invalid @enderror" value="{{old('hasil_pengolahan')}}" required>
                            @error('hasil_pengolahan')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="nama">Produk <code>*)</code></label>

                              <select class="js-example-basic-single form-control-sm @error('produk_id')
                                  is-invalid
                              @enderror" name="produk_id"  style="width: 100%" >
                                  <option disabled selected value=""> Pilih Produk</option>
                                  @foreach ($produk as $t)
                                      <option value="{{ $t->id }}"> {{$t->nama}}</option>
                                  @endforeach
                                </select>

                            @error('produk_id')<div class="invalid-feedback"> {{$message}}</div>
                            @enderror

                          </div>

                        <div class="form-group col-md-5 col-5 mt-0 ml-5">
                            <label for="jml">Jumlah Hasil Pengolahan<code>*)</code></label>
                            <input type="number" min="1" name="jml" id="jml" class="form-control @error('jml') is-invalid @enderror" value="{{old('jml')}}" required>
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
