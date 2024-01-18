@extends('layout/menu')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $data['title'] }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $data['title'] }}</h5>
                    @include('message/errors')
                    <!-- Vertical Form -->
                    <form class="row g-3" method="POST" action="{{ route('admin.siswa.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Lembaga</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" id="selLembaga" name="selLembaga">
                                    @if (session()->has('txtLembaga'))
                                        <option value="{{ Session::get('selLembaga') }}">
                                            {{ Session::get('txtLembaga') }}
                                        </option>
                                    @else
                                        <option value="" selected disabled>Pilih Lembaga</option>
                                    @endif
                                    @foreach ($data['lembaga'] as $lmb)
                                        <option value="{{ $lmb->lembaga_id }}">
                                            {{ $lmb->nama_lembaga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="txtSiswaNis" class="col-sm-2 col-form-label">Nis</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="txtSiswaNis" name="txtSiswaNis"
                                    value="{{ Session::get('txtSiswaNis') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtSiswaName" class="col-sm-2 col-form-label">Nama Siswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSiswaName" name="txtSiswaName"
                                    value="{{ Session::get('txtSiswaName') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtSiswaEmail" class="col-sm-2 col-form-label">Email Siswa</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="txtSiswaEmail" name="txtSiswaEmail"
                                    value="{{ Session::get('txtSiswaEmail') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txtSiswaFoto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" accept=".jpg, .png" class="form-control" id="txtSiswaFoto" name="txtSiswaFoto"  max="100000" >
                                <small class="form-text text-muted">Ukuran file maksimal: 100 KB. Format yang diizinkan: JPG, PNG.</small>
                            </div>
                        </div>

                        

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <script>
        $(document).ready(function() {

            $('input[type="text"]').on('input', function() {
                $(this).val(function(_, val) {
                    return val.toUpperCase();
                });
            });
        }); 
    </script>

@endsection
