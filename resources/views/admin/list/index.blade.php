@extends('admin.layout.master')

@section('isi')
<div class="container" id="container">
    <h1 style="text-align: center;">Daftar Surat</h1>

    <ul class="nav nav-tabs" id="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1" data-toggle="tab" href="#content1" role="tab">Tab 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#content2" role="tab">Tab 2</a>
        </li>
    </ul>

    <div class="d-flex justify-content-between mt-3">
        <input type="text" id="search" class="form-control" placeholder="Cari Surat..." style="width: 200px;">
        <button class="btn btn-secondary" id="addDataBtn">Input Data</button>
    </div>

    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="content1" role="tabpanel">
            <div class="tab-title">Antrian</div>
            <div class="surat-list" id="surat-list-1" style="text-align: center;">
            </div>
            <div id="showing-info-1" style="text-align: center; margin-top: 10px;"></div>

            <nav>
                <ul class="pagination" id="pagination-1">
                    <li class="page-item disabled" id="prev-1"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" id="next-1"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="content2" role="tabpanel">
            <div class="tab-title">Selesai</div>
            <div class="surat-list" id="surat-list-2" style="text-align: center;">
            </div>
            <div id="showing-info-2" style="text-align: center; margin-top: 10px;"></div>

            <nav>
                <ul class="pagination" id="pagination-2">
                    <li class="page-item disabled" id="prev-2"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" id="next-2"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
    document.getElementById('addDataBtn').addEventListener('click', function() {
        window.location.href = "{{ route('dispo.index') }}";
    });
</script>
<script src="{{ asset('js/admin/list/list.js') }}"></script>
<script>
    window.riwayatIndexUrl = "{{ route('riwayat.index') }}";
    window.prosesIndexUrl = "{{ route('proses.index') }}";
    window.editIndexUrl = "{{ route('edit.index') }}";
</script>
@endsection