document.addEventListener("DOMContentLoaded", async function () {
    const urlParams = new URLSearchParams(window.location.search);
    const urlNoDisposisi = urlParams.get("no_disposisi"); // Ambil dari URL
    let storedNoDisposisi = localStorage.getItem("no_disposisi");
    window.history.replaceState({}, document.title, window.location.pathname);

    console.log("No Disposisi dari URL:", urlNoDisposisi);
    console.log(
        "No Disposisi dari localStorage sebelum update:",
        storedNoDisposisi
    );

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
        const response = await fetch(
            `/api/get-dispo?no_disposisi=${storedNoDisposisi}`
        );
        const data = await response.json();

        if (response.ok) {
            document.getElementById("id_tipe").value = data.id_tipe;
            document.getElementById("nomor_surat").value = data.no_surat;

            let nomorDisposisiField =
                document.getElementById("nomor_disposisi");
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

document
    .getElementById("pdf-file")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const fileURL = URL.createObjectURL(file);
            updatePreview(fileURL, file.name);
        } else {
            clearPreview();
        }
    });

document
    .getElementById("editForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        let nomorDisposisi = document.getElementById("nomor_disposisi").value;
        let messageContainer = document.getElementById("message-container");
        nomorDisposisi = nomorDisposisi.replace(/\//g, "-");

        // Tambahkan _method=PUT agar Laravel memahami ini sebagai update
        formData.append("_method", "PUT");

        fetch(`/admin/edit/${nomorDisposisi}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then((jsonData) => {
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
            .catch((error) => {
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
