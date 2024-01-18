@extends('layout/menu')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data {{ $data['title'] }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datatables</h5>
                            @include('message/errors')
                            <a href="{{ route('admin.siswa.create') }}">
                                <button type="button" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i> Add Siswa
                                    </button>
                            </a>

                            <a href="{{ route('admin.siswa.export') }}">
                                <button type="button" class="btn btn-primary mb-3"><i class="ri ri-file-excel-2-line">
                                    </i> Export Excel
                                </button>
                            </a>


                            <!-- Table with stripped rows -->
                            <table class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Lembaga</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['siswa'] as $index => $sw)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $sw->id }}</td>
                                            <td>{{ $sw->nis }}</td>
                                            <td>{{ $sw->nama_siswa }}</td>
                                            <td>{{ $sw->email }}</td>
                                            <td>{{ $sw->lembaga->nama_lembaga }}</td>
                                            <td>
                                                <img src="{{ asset('storage/foto-siswa/'. $sw->foto_path ) }}" alt="" width="150px">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.siswa.edit', $sw->id) }}">
                                                    <button type="button" class="btn btn-primary mb-3"><i
                                                            class="bi bi-pencil-square"></i> Edit</button>
                                                </a>

                                                <form style="display: inline" method="POST"
                                                    action="{{ route('admin.siswa.destroy', $sw->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button"
                                                        class="btn btn-xs btn-danger mb-3 btn-flat show-alert-delete-box">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        $(document).ready(function() {

            $('.show-alert-delete-box').on('click', function() {
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this item!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
