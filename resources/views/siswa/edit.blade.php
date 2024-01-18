@extends('layout/menu')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $data['title'] }}</h5>
                    @include('message/errors')
                    <!-- Vertical Form -->
                    <form class="row g-3" method="POST" action="{{ route('admin.siswa.update', $data['siswa']->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
        
                        <div class="row mb-3">
                            <label for="selLembaga" class="col-sm-2 col-form-label">Lembaga</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="selLembaga" name="selLembaga" required>
                                    <option value="" selected disabled>Pilih Lembaga</option>
                                    @foreach ($data['lembaga'] as $lembaga)
                                        <option value="{{ $lembaga->id }}" {{ ($data['siswa']->lembaga_id == $lembaga->id) ? 'selected' : '' }}>
                                            {{ $lembaga->nama_lembaga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="txtSiswaNis" class="col-sm-2 col-form-label">Nis</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="txtSiswaNis" name="txtSiswaNis" value="{{ old('txtSiswaNis', $data['siswa']->nis) }}">
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="txtSiswaName" class="col-sm-2 col-form-label">Nama Siswa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtSiswaName" name="txtSiswaName" value="{{ old('txtSiswaName', $data['siswa']->nama_siswa) }}">
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="txtSiswaEmail" class="col-sm-2 col-form-label">Email Siswa</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="txtSiswaEmail" name="txtSiswaEmail" value="{{ old('txtSiswaEmail', $data['siswa']->email) }}">
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="txtSiswaFoto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                @if ($data['siswa']->foto_path)
                                    <img src="{{ asset('storage/foto-siswa/'.$data['siswa']->foto_path) }}" alt="Foto Siswa" class="img-fluid mb-2" style="max-height: 150px;">
                                @endif
                                <input type="file" accept=".jpg, .png" class="form-control" id="txtSiswaFoto" name="txtSiswaFoto" max="100000">
                                <small class="form-text text-muted">Ukuran file maksimal: 100 KB. Format yang diizinkan: JPG, PNG.</small>
                        
                                @if (!$data['siswa']->foto_path)
                                    <input type="hidden" name="txtSiswaFotoPath" value="{{ $data['siswa']->foto_path }}">
                                @endif
                            </div>
                        </div>
                        
        
        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
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
