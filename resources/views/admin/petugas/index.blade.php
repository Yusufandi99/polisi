@extends('admin.layout.master')

@section('isi')
<div class="container">
    <h1 style="text-align: center;">Form Input Data Petugas</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form method="POST" action="{{ route('petugas.store') }}">
        @csrf

        <div class="form-group">
            <label for="nama_petugas">Nama Petugas</label>
            <input type="text" name="nama_petugas" class="form-control" value="{{ old('nama_petugas') }}" required>
        </div>

        <div class="form-group">
            <label for="id_devisi">Divisi</label>
            <select name="id_devisi" class="form-control" required>
                <option value="" selected disabled>-- Pilih Divisi --</option>
                <option value="1" {{ old('id_devisi') == '1' ? 'selected' : '' }}>Bripda</option>
                <option value="2" {{ old('id_devisi') == '2' ? 'selected' : '' }}>Kolonel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <select name="jabatan" class="form-control" required>
                <option value="" selected disabled>-- Pilih Jabatan --</option>
                <option value="kapolsek" {{ old('jabatan') == 'kapolsek' ? 'selected' : '' }}>Kapolsek</option>
                <option value="anggota" {{ old('jabatan') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                <option value="kanit" {{ old('jabatan') == 'kanit' ? 'selected' : '' }}>Kanit</option>
                <option value="piket" {{ old('jabatan') == 'piket' ? 'selected' : '' }}>Piket</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_login">User Login</label>
            <input type="text" name="user_login" class="form-control" value="{{ old('user_login') }}" required>
        </div>

        <div class="form-group">
    <label for="pass_login">Password</label>
    <div class="input-group">
        <input type="password" name="pass_login" id="pass_login" class="form-control" required oninput="checkPasswordLength()">
        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁</button>
    </div>
    <small id="passwordWarning" style="color: red; display: none;">Password maksimal 8 karakter!</small>
</div>


        <button type="submit" class="btn btn-secondary">Simpan</button>
    </form>
    <div id="responseMessage" style="display: none;"></div>
</div>
@endsection