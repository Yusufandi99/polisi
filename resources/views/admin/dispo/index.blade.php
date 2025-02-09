@extends('admin.layout.master')
@section('isi')
<div class="container">
    <a href="{{ route('list.index') }}"
        style="display: inline-block; 
          text-decoration: none; 
          color: rgb(99, 104, 109); 
          font-size: 24px; 
          font-weight: bold;
          margin-bottom: 10px;">
        &#x2B05;
    </a>


    <h2 style="text-align: center;">Input Data Disposisi</h2>
    <br>
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

    <form method="POST" action="{{ route('dispo.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="id_tipe">Tipe Surat</label>
            <select id="id_tipe" name="id_tipe" class="form-control" required>
                <option value="" disabled {{ old('id_tipe') ? '' : 'selected' }}>-- Pilih Tipe Surat --</option>
                <option value="100" {{ old('id_tipe') == '100' ? 'selected' : '' }}>Surat Masuk</option>
                <option value="200" {{ old('id_tipe') == '200' ? 'selected' : '' }}>Surat Keluar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="Masukkan nomor surat" value="{{ old('nomor_surat') }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_disposisi">Nomor Disposisi</label>
            <input type="text" id="nomor_disposisi" name="nomor_disposisi" class="form-control" placeholder="Masukkan nomor disposisi" value="{{ old('nomor_disposisi') }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat') }}" required>
        </div>

        <div class="form-group">
            <label for="prihal">Perihal</label>
            <textarea id="prihal" name="prihal" class="form-control" rows="4" placeholder="Masukkan perihal surat" required>{{ old('prihal') }}</textarea>
        </div>

        <div class="form-group">
            <label for="kepada">Kepada</label>
            <input type="text" id="kepada" name="kepada" class="form-control" placeholder="Masukkan kepada siapa surat ini ditujukan" value="{{ old('kepada') }}" required>
        </div>

        <div class="form-group">
            <label for="prioritas">Prioritas</label>
            <select id="prioritas" name="prioritas" class="form-control" required>
                <option value="" disabled {{ old('prioritas') ? '' : 'selected' }}>-- Pilih Prioritas --</option>
                <option value="SEGERA" {{ old('prioritas') == 'SEGERA' ? 'selected' : '' }}>Segera</option>
                <option value="TENTATIF" {{ old('prioritas') == 'TENTATIF' ? 'selected' : '' }}>Tentatif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sifat_surat">Sifat Surat</label>
            <select id="sifat_surat" name="sifat_surat" class="form-control" required>
                <option value="" disabled {{ old('sifat_surat') ? '' : 'selected' }}>-- Pilih Sifat Surat --</option>
                <option value="PENTING" {{ old('sifat_surat') == 'PENTING' ? 'selected' : '' }}>Penting</option>
                <option value="UMUM" {{ old('sifat_surat') == 'UMUM' ? 'selected' : '' }}>Umum</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pdf-file">Upload File Dispo (pdf)</label>
            <input type="file" id="pdf-file" name="pdf" class="form-control-file" accept=".pdf" required>
            <!-- Catatan: Karena alasan keamanan, input file tidak dapat dipertahankan nilainya saat terjadi error -->
            <a id="pdf-preview-link" href="#" target="_blank" style="display: none;">Lihat Preview</a>
        </div>

        <button type="submit" class="btn btn-secondary">Simpan</button>
    </form>


    <div id="responseMessage" style="display: none;"></div>
</div>
<script src="{{ asset('js/admin/petugas/petugas.js') }}"></script>
<script>
    document.getElementById("pdf-file").addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (file && file.type === "application/pdf") {
            const objectURL = URL.createObjectURL(file);
            document.getElementById("pdf-preview-link").href = objectURL;
            document.getElementById("pdf-preview-link").style.display = "inline-block";
        }
    });
</script>
@endsection