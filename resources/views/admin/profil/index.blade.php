@extends('admin.layout.master')

@section('isi')
<br><br><br>
<div class="container mt-4">

    <div class="card shadow-lg p-4 mt-3 mx-auto text-center" style="max-width: 600px; border-radius: 15px;"><br>
        <h2 class="text-center fw-bold">Profil Admin</h2><br>
        <i class="fas fa-user-circle fa-5x text-secondary mb-3"></i>

        <h4 class="fw-bold">{{ $petugas->nama_petugas }}</h4>
        <p class="text-muted">{{ $petugas->deskripsi_devisi }}</p>

        <div class="mt-4 text-start">
            <table class="table table-borderless mx-auto" style="width: auto;">
                <tr>
                    <td class="align-middle"><i class="fas fa-user fa-lg text-secondary me-3"></i></td>
                    <td class="text-start"><strong>Username:</strong></td>
                    <td class="text-start">{{ $petugas->user_login }}</td>
                </tr>
                <tr>
                    <td class="align-middle"><i class="fas fa-user-tie fa-lg text-primary me-3"></i></td>
                    <td class="text-start"><strong>Jabatan:</strong></td>
                    <td class="text-start">{{ $petugas->jabatan }}</td>
                </tr>
            </table>
            <div class="btn btn-secondary btn-sm rounded-pill px-4">
                <a href="{{ url('/edit_profile/' . $petugas->id) }}" class="btn btn-secondary">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection