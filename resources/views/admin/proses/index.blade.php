@extends('admin.layout.master')

@section('isi')
<div class="container" id="container">
    <main>
    <a href="{{ route('list.index') }}" class="btn btn-secondary mb-3">&#x2B05; Kembali</a>
        <div class="detail-title"><b style="font-size: 24px;">Form Validasi Surat</b></div><br>
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
 <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th width="30%">No Disposisi</th>
                <td id="no-surat-display"><b></b></td>
            </tr>
            <tr>
                <th>No Surat</th>
                <td><b id="no_surat"></b></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><b id="tanggal"></b></td>
            </tr>
            <tr>
                <th>Perihal</th>
                <td><b id="perihal"></b></td>
            </tr>
            <tr>
                <th>Kepada</th>
                <td><b id="kepada-display"></b></td>
            </tr>
            <tr>
                <th>Validasi Terakhir</th>
                <td><b id="devisi"></b></td>
            </tr>
            <tr>
                <th>Prioritas</th>
                <td><b id="prioritas"></b></td>
            </tr>
            <tr>
                <th>Sifat Surat</th>
                <td><b id="sifat_surat"></b></td>
            </tr>
           <tr>
    <th>File PDF</th>
    <td>
        <b id="file-pdf"></b>
        <button id="btnPreviewPdf" class="btn btn-primary btn-sm" style="display: none;">Preview PDF</button>
    </td>
</tr>
        </tbody>
    </table>

        <form action="{{ route('proses.store') }}" method="POST">
            @csrf
            <input type="hidden" name="no_disposisi" id="no_disposisi" value="">
            <input type="hidden" name="id_petugas_validasi" value="{{ session('user_id') }}">


            <label>Uraian:</label>
            <textarea id="uraian" name="uraian" class="form-control" rows="3" placeholder="Masukkan uraian..." required></textarea><br>

            <label>Status Disposisi:</label>
            <select id="id_status" name="id_status" class="form-control" required>
                <option value="" selected disabled>Pilih Status Disposisi</option>
                @foreach($statusList as $status)
                    <option value="{{ $status->id_status }}">{{ $status->deskripsi_status }}</option>
                @endforeach
            </select><br>

            <label>Lanjut Ke Devisi:</label>
            <select id="id_devisi" name="id_devisi" class="form-control" required>
                <option value="" selected disabled>Pilih Devisi</option>
                @foreach($devisiList as $devisi)
                    <option value="{{ $devisi->id_devisi }}">{{ $devisi->deskripsi_devisi }}</option>
                @endforeach
            </select><br>

            <div style="text-align: right; margin-right: 20px;">
                Surat ditandai selesai oleh :
                <div>
                    <b>{{ $petugas->nama_petugas ?? 'Tidak Diketahui' }}</b>
                    (<i>{{ $petugas->jabatan ?? '-' }}</i>)
                </div>
                <br>
               <div id="reading-info" style="font-size: 12px; color: gray;"></div>

                <br>
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="submit" class="btn btn-success" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </form>
    </main>
</div>
<script src="{{ asset('js/admin/proses/proses.js') }}"></script>
@endsection