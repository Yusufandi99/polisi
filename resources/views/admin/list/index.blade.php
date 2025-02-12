@extends('admin.layout.master')
@section('isi')
<div class="container" id="container">
    <h1 style="text-align: center;">Daftar Surat</h1>

    <ul class="nav nav-tabs" id="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1" data-toggle="tab" href="#content1" role="tab">Antrian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2" data-toggle="tab" href="#content2" role="tab">Selesai</a>
        </li>
    </ul>

    <div class="d-flex flex-row align-items-center justify-content-between mt-3">
    <input type="text" id="search" class="form-control me-2" placeholder="Cari Surat..." style="width: 200px;">
    <button class="btn btn-secondary" id="addDataBtn">Input Data</button>
</div>

    
    <div class="d-flex flex-column flex-md-row mt-2">
        <select id="filterDevisi" class="form-control" style="width: 200px;">
            <option value="">Semua Devisi</option>
        </select>
    </div>

    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="content1" role="tabpanel">
            <div class="tab-title">Antrian</div>
            <div class="surat-list" id="surat-list-1"></div>
            <div id="showing-info-1" class="text-center mt-2"></div>
            <nav>
                <ul class="pagination" id="pagination-1"></ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="content2" role="tabpanel">
            <div class="tab-title">Selesai</div>
            <div class="surat-list" id="surat-list-2"></div>
            <div id="showing-info-2" class="text-center mt-2"></div>
            <nav>
                <ul class="pagination" id="pagination-2"></ul>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("/get-devisi")
            .then(response => response.json())
            .then(data => {
                let filterDevisi = document.getElementById("filterDevisi");
                data.forEach(devisi => {
                    let option = document.createElement("option");
                    option.value = devisi.id_devisi;
                    option.textContent = devisi.deskripsi_devisi;
                    filterDevisi.appendChild(option);
                });
            })
            .catch(error => console.error("Error fetching devisi data:", error));
    });

    document.getElementById("filterDevisi").addEventListener("change", function () {
        loadData(getActiveTab());
    });

    document.getElementById("search").addEventListener("input", function () {
        loadData(getActiveTab());
    });

    function getActiveTab() {
        return document.querySelector(".nav-link.active").id === "tab1" ? 1 : 2;
    }

    function loadData(tabId) {
        const searchQuery = document.getElementById("search").value.toLowerCase();
        const filterDevisi = document.getElementById("filterDevisi").value;

        fetch(`/api/dispo?closing=${tabId === 1 ? 0 : 1}`)
            .then(response => response.json())
            .then(data => {
                if (searchQuery) {
                    data = data.filter(item => item.no_disposisi.toLowerCase().includes(searchQuery));
                }
                if (filterDevisi) {
                    data = data.filter(item => item.id_devisi == filterDevisi);
                }
                updatePagination(tabId, data);
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    loadData(1);
</script>
@endsection