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

<script>
// document.addEventListener("DOMContentLoaded", async function() {
//     const storedNoDisposisi = localStorage.getItem("no_disposisi");
//     window.history.replaceState({}, document.title, window.location.pathname);

//     if (!storedNoDisposisi) {
//         console.error("No disposisi tidak ditemukan di localStorage.");
//         return;
//     }

//     try {
//         const response = await fetch(`/api/get-dispo?no_disposisi=${storedNoDisposisi}`);
//         const data = await response.json();

//         if (response.ok) {
//             document.getElementById("id_tipe").value = data.id_tipe;
//             document.getElementById("nomor_surat").value = data.no_surat;
            
//             let nomorDisposisiField = document.getElementById("nomor_disposisi");
//             nomorDisposisiField.readOnly = false;
//             nomorDisposisiField.value = data.no_disposisi;
//             nomorDisposisiField.readOnly = true;

//             document.getElementById("tanggal_surat").value = data.tgl_dispo;
//             document.getElementById("prihal").value = data.prihal;
//             document.getElementById("kepada").value = data.kepada;
//             document.getElementById("prioritas").value = data.prioritas;
//             document.getElementById("sifat_surat").value = data.sifat_surat;

//             if (data.file_pdf) {
//                 updatePreview(`/uploads/dispo/${data.file_pdf}`, data.file_pdf);
//             }
//         } else {
//             console.error("Error mengambil data:", data.error);
//         }
//     } catch (error) {
//         console.error("Error fetching data:", error);
//     }
// });

document.addEventListener("DOMContentLoaded", async function () {
    const urlParams = new URLSearchParams(window.location.search);
    const urlNoDisposisi = urlParams.get("no_disposisi"); // Ambil dari URL
    let storedNoDisposisi = localStorage.getItem("no_disposisi");
    window.history.replaceState({}, document.title, window.location.pathname);

    console.log("No Disposisi dari URL:", urlNoDisposisi);
    console.log("No Disposisi dari localStorage sebelum update:", storedNoDisposisi);

    // Jika ada `no_disposisi` di URL, paksa update localStorage
    if (urlNoDisposisi) {
        localStorage.setItem("no_disposisi", urlNoDisposisi);
        storedNoDisposisi = urlNoDisposisi; // Pastikan variabelnya ikut berubah
        console.log("LocalStorage diperbarui ke:", urlNoDisposisi);
    }

    // Jika masih kosong, hentikan proses
    if (!storedNoDisposisi) {
        console.error("No disposisi tidak ditemukan.");
        return;
    }

    // Fetch data dari API
    try {
        const response = await fetch(`/api/get-dispo?no_disposisi=${storedNoDisposisi}`);
        const data = await response.json();

        if (response.ok) {
            document.getElementById("id_tipe").value = data.id_tipe;
            document.getElementById("nomor_surat").value = data.no_surat;

            let nomorDisposisiField = document.getElementById("nomor_disposisi");
            nomorDisposisiField.readOnly = false;
            nomorDisposisiField.value = data.no_disposisi;
            nomorDisposisiField.readOnly = true;

            document.getElementById("tanggal_surat").value = data.tgl_dispo;
            document.getElementById("prihal").value = data.prihal;
            document.getElementById("kepada").value = data.kepada;
            document.getElementById("prioritas").value = data.prioritas;
            document.getElementById("sifat_surat").value = data.sifat_surat;

            if (data.file_pdf) {
                updatePreview(`/uploads/dispo/${data.file_pdf}`, data.file_pdf);
            }
        } else {
            console.error("❌ Error mengambil data:", data.error);
        }
    } catch (error) {
        console.error("❌ Error fetching data:", error);
    }
});


document.getElementById("pdf-file").addEventListener("change", function(event) {
    const file = event.target.files[0];

    if (file) {
        const fileURL = URL.createObjectURL(file);
        updatePreview(fileURL, file.name);
    } else {
        clearPreview();
    }
});

document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);
    let nomorDisposisi = document.getElementById("nomor_disposisi").value;
    let messageContainer = document.getElementById("message-container");
    nomorDisposisi = nomorDisposisi.replace(/\//g, '-');

    // Tambahkan _method=PUT agar Laravel memahami ini sebagai update
    formData.append("_method", "PUT");

    fetch(`/admin/edit/${nomorDisposisi}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(jsonData => {
        console.log(jsonData);

        if (jsonData.success) {
            messageContainer.innerHTML = `<div class="alert alert-success">${jsonData.message}</div>`;
            localStorage.setItem("no_disposisi", nomorDisposisi);
        } else {
            messageContainer.innerHTML = `<div class="alert alert-danger">${jsonData.message}</div>`;
        }

        setTimeout(() => {
            messageContainer.innerHTML = "";
        }, 3000);
    })
    .catch(error => {
        console.error("Error:", error);
        messageContainer.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan saat mengupdate data.</div>`;
    });
});

function updatePreview(fileURL, fileName) {
    const pdfPreviewLink = document.getElementById("pdf-preview-link");
    const pdfFileNameDiv = document.getElementById("pdf-file-name");

    pdfPreviewLink.href = fileURL;
    pdfPreviewLink.style.display = "inline";
    pdfPreviewLink.textContent = "Lihat Preview";

    pdfFileNameDiv.innerHTML = `<strong>File baru:</strong> ${fileName}`;
}

function clearPreview() {
    document.getElementById("pdf-preview-link").style.display = "none";
    document.getElementById("pdf-file-name").innerHTML = "";
}
</script>

@endsection
