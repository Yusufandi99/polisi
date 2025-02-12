@extends('admin.layout.master')

@section('isi')
<div class="container">
    <a href="{{ route('list.index') }}" class="btn btn-secondary mb-3">&#x2B05; Kembali</a>

    <h2 class="text-center">Edit Data Disposisi</h2>
    <br>

    <form id="editForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div id="message-container"></div>

        <div class="form-group">
            <label for="id_tipe">Tipe Surat</label>
            <select id="id_tipe" name="id_tipe" class="form-control" required>
                <option value="100">Surat Masuk</option>
                <option value="200">Surat Keluar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nomor_disposisi">Nomor Disposisi</label>
            <input type="text" id="nomor_disposisi" name="nomor_disposisi" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prihal">Perihal</label>
            <textarea id="prihal" name="prihal" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="kepada">Kepada</label>
            <input type="text" id="kepada" name="kepada" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prioritas">Prioritas</label>
            <select id="prioritas" name="prioritas" class="form-control" required>
                <option value="SEGERA">Segera</option>
                <option value="TENTATIF">Tentatif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sifat_surat">Sifat Surat</label>
            <select id="sifat_surat" name="sifat_surat" class="form-control" required>
                <option value="PENTING">Penting</option>
                <option value="UMUM">Umum</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pdf-file">Upload File Dispo (PDF)</label>
            <input type="file" id="pdf-file" name="pdf" class="form-control-file" accept=".pdf">
            <div id="pdf-file-name" style="margin-top: 5px;"></div>
            <a id="pdf-preview-link" href="#" target="_blank" style="display: none;">Lihat Preview</a>
        </div>

        <button type="submit" class="btn btn-secondary">Update</button>
    </form>

    <div id="alert-box" style="display: none; margin-top: 10px;"></div>
</div>
<script src="{{ asset('js/admin/edit/edit.js') }}"></script>

@endsection