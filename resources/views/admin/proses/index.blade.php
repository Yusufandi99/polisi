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

        <table width="100%">
            <tr>
                <td id="no-surat-display" style="white-space: nowrap;">No Disposisi : <b></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">No Surat : <b id="no_surat"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Tanggal : <b id="tanggal"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Perihal : <b id="perihal"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Kepada : <b id="kepada-display"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Validasi Terakhir : <b id="devisi"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Prioritas : <b id="prioritas"></b></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;">Sifat Surat : <b id="sifat_surat"></b></td>
            </tr>
            <!-- <tr>
                <td style="white-space: nowrap;">Petugas Input Surat : <b id="petugas"></b></td>
            </tr> -->
            <tr>
                <td style="white-space: nowrap;">File PDF: <b id="file-pdf"></b></td>
            </tr>
            <button id="btnPreviewPdf" class="btn btn-primary btn-sm" style="display: none; font-size: 12px; padding: 5px 10px;">Preview PDF</button><br>
        </table><br>

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
                    <button type="button" class="btn btn-danger">Batal</button>
                </div>
            </div>
        </form>
    </main>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const storedNoSurat = localStorage.getItem('no_disposisi');
    document.querySelector("#no_disposisi").value = storedNoSurat;
});


document.addEventListener("DOMContentLoaded", async function () {
    // Paksa ambil no_disposisi dari URL jika ada
    const params = new URLSearchParams(window.location.search);
    const queryNoDisposisi = params.get("no_disposisi");

    if (queryNoDisposisi) {
        console.log("Updating localStorage with no_disposisi:", queryNoDisposisi);
        localStorage.setItem("no_disposisi", queryNoDisposisi);
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    // Paksa refresh dari localStorage
    const storedNoDisposisi = localStorage.getItem("no_disposisi");

    if (!storedNoDisposisi) {
        console.error("No disposisi tidak ditemukan di localStorage.");
        return;
    }

    console.log("Stored no_disposisi:", storedNoDisposisi);

    // Tampilkan di input field
    const inputNoDisposisi = document.querySelector("#no_disposisi");
    if (inputNoDisposisi) {
        inputNoDisposisi.value = storedNoDisposisi;
    }

    // Tampilkan di elemen lain
    const displayElement = document.querySelector("#no-surat-display b");
    if (displayElement) {
        displayElement.textContent = storedNoDisposisi;
    }

    // Ambil data dari API
    try {
        const response = await fetch(`/api/get-dispo?no_disposisi=${storedNoDisposisi}`);
        const data = await response.json();

        if (response.ok && data) {
            document.querySelector("#kepada-display").textContent = data.kepada || "Tidak ada data";
            document.querySelector("#no_surat").textContent = data.no_surat || "Tidak ada perihal";
            document.querySelector("#tanggal").textContent = data.tgl_dispo || "Tidak ada tanggal";
            document.querySelector("#perihal").textContent = data.prihal || "Tidak ada perihal";
            document.querySelector("#devisi").textContent = data.deskripsi_devisi || "Tidak ada devisi";
            document.querySelector("#prioritas").textContent = data.prioritas || "Tidak ada prioritas";
            document.querySelector("#sifat_surat").textContent = data.sifat_surat || "Tidak ada sifat_surat";
        } else {
            console.error("Data dispo tidak ditemukan atau kosong.");
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }

    // Event listener untuk tombol simpan
    document.querySelector("#btnSimpan").addEventListener("click", async function () {
        const uraian = document.querySelector("#uraian").value;
        const id_status = document.querySelector("#id_status").value;
        const id_devisi = document.querySelector("#id_devisi").value;

        const response = await fetch("/api/save-dispo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                no_disposisi: storedNoDisposisi,
                id_petugas_validasi: "{{ session('user_id') }}",
                uraian: uraian,
                id_status: id_status,
                id_devisi: id_devisi
            })
        });

        const result = await response.json();
        if (result.success) {
            alert("Data berhasil disimpan!");
            location.reload();
        } else {
            alert("Gagal menyimpan data!");
        }
    });
});

</script>

<script>
document.addEventListener("DOMContentLoaded", async function() {
    const storedNoSurat = localStorage.getItem('no_disposisi');
    document.querySelector("#no-surat-display b").textContent = storedNoSurat ? storedNoSurat : "Tidak ada";

    if (!storedNoSurat) {
        console.error("No disposisi tidak ditemukan.");
        return;
    }

    try {
        const dispoResponse = await fetch(`/api/get-dispo?no_disposisi=${storedNoSurat}`);
        const dispoData = await dispoResponse.json();

        if (dispoData && dispoData.file_pdf) {
            const pdfPath = `/uploads/dispo/${dispoData.file_pdf.replaceAll("/", "")}`;
            document.querySelector("#file-pdf").textContent = dispoData.file_pdf;
            const btnPreview = document.querySelector("#btnPreviewPdf");
            btnPreview.style.display = "inline-block";
            btnPreview.addEventListener("click", function() {
                window.open(pdfPath, "_blank");
            });
        } else {
            console.error("File PDF tidak ditemukan.");
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const readingInfo = document.querySelector("#reading-info");
    
    const now = new Date();
    const formattedTime = now.toLocaleString("id-ID", {
        weekday: "long", 
        year: "numeric", 
        month: "long", 
        day: "numeric", 
        hour: "2-digit", 
        minute: "2-digit", 
        second: "2-digit"
    });

    readingInfo.textContent = `Anda membaca pada ${formattedTime}`;
});

document.addEventListener("DOMContentLoaded", async function() {
    const storedNoSurat = localStorage.getItem('no_disposisi');

    if (!storedNoSurat) {
        console.error("No disposisi tidak ditemukan.");
        return;
    }

    try {
        const response = await fetch(`/api/check-validasi?no_disposisi=${storedNoSurat}`);
        const data = await response.json();

        if (data.validated) {  
            document.querySelector("#btnSimpan").style.display = "none"; 
            document.querySelector(".btn-danger").style.display = "none"; 
            
      
            const infoText = document.createElement("p");
            infoText.textContent = "Anda sudah validasi";
            infoText.style.color = "green";
            infoText.style.fontWeight = "bold";
            infoText.style.textAlign = "center";
            document.querySelector("#container").appendChild(infoText);
        }

    } catch (error) {
        console.error("Error fetching validation status:", error);
    }
});


</script>


@endsection