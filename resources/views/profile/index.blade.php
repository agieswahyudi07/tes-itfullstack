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
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ asset('assets/img/agies.jpg') }}" alt="Profile" class="rounded-circle" width="500">
                            <h2>Ramadhan Agies Ananda Wahyudi</h2>
                            <h3>IT FullStack</h3>
                            <div class="social-links mt-2">
                              <a href="https://instagram.com/agieswahyudi" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                              <a href="https://www.linkedin.com/in/agieswahyudi" class="linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
                              <a href="https://github.com/agieswahyudi07" class="github" target="_blank"><i class="bi bi-github"></i></a>
                            </div>
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
