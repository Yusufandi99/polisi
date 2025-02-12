@extends('admin.layout.master')

@section('isi')
<br><br><br>
<div class="container mt-4">
    <div class="card shadow-lg p-4 mt-3 mx-auto" style="max-width: 600px; border-radius: 15px;">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <a href="{{ route('profil.index') }}" class="btn btn-secondary mb-3">&#x2B05; Kembali</a>
            </div>
            <div></div>
        </div>
        <br>
        <h2 class="text-center fw-bold">Profil Admin</h2><br>
        <div id="alertMessage" class="alert d-none" role="alert"></div>
        <div class="mb-3">
            <label for="storedProfileId" class="form-label">ID Profil</label>
            <input type="text" id="storedProfileId" name="profile_id" class="form-control" value="{{ $profileId }}" readonly>
        </div>

        <div class="mb-3">
            <label for="userLogin" class="form-label">Username</label>
            <input type="text" id="userLogin" name="user_login" class="form-control" value="{{ $userLogin }}" readonly>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Ganti Password Baru" maxlength="8" oninput="validatePassword()">
            <small id="passwordError" class="text-danger" style="display: none;">⚠ Maksimal 8 karakter!</small>
        </div>
        
        <div class="d-flex justify-content-center">
            <button class="btn btn-secondary btn-md rounded-pill px-4" onclick="updatePassword()">
                <i class="fas fa-edit me-2"></i> Edit Profil
            </button>
        </div>
    </div>
</div>
@extends('admin.profil.script')


@endsection