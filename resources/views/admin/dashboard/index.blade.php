@extends('admin.layout.master')

@section('isi')
<div class="container mt-4">
    <br><br>
    <h1 class="text-center mt-3 mb-4 text-uppercase font-weight-bold">Dashboard</h1>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-5 col-10 mb-3">
            <div class="card bg-primary text-white shadow-lg rounded-lg p-3">
                <div class="card-body text-center">
                    <i class="fas fa-envelope-open-text fa-3x mb-2"></i> <!-- Ikon Surat Masuk -->
                    <h3 class="card-title">Surat Masuk</h3>
                    <p class="card-text" style="font-size: 28px; font-weight: bold;">{{ $totalMasuk }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-10 mb-3">
            <div class="card bg-success text-white shadow-lg rounded-lg p-3">
                <div class="card-body text-center">
                    <i class="fas fa-paper-plane fa-3x mb-2"></i> <!-- Ikon Surat Keluar -->
                    <h3 class="card-title">Surat Keluar</h3>
                    <p class="card-text" style="font-size: 28px; font-weight: bold;">{{ $totalKeluar }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-10 mb-3">
            <div class="card bg-info text-white shadow-lg rounded-lg p-3">
                <div class="card-body text-center">
                    <i class="fas fa-list-alt fa-3x mb-2"></i> <!-- Ikon Daftar Antrian -->
                    <h3 class="card-title">Daftar Antrian</h3>
                    <p class="card-text" style="font-size: 28px; font-weight: bold;">{{ $totalAntrian }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-10 mb-3">
            <div class="card bg-warning text-dark shadow-lg rounded-lg p-3">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-3x mb-2"></i> <!-- Ikon Daftar Selesai -->
                    <h3 class="card-title">Daftar Selesai</h3>
                    <p class="card-text" style="font-size: 28px; font-weight: bold;">{{ $totalSelesai }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection