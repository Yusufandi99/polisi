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
        if (data.closing === 1) { 
            // Jika closing = 1, sembunyikan tombol dan tampilkan pesan
            document.querySelector("#btnSimpan").style.display = "none"; 
            document.querySelector(".btn-danger").style.display = "none"; 

            const infoText = document.createElement("p");
            infoText.textContent = "Anda sudah validasi";
            infoText.style.color = "green";
            infoText.style.fontWeight = "bold";
            infoText.style.textAlign = "center";
            document.querySelector("#container").appendChild(infoText);
        } else {
            // Jika closing = 0, pastikan tombol tetap muncul
            document.querySelector("#btnSimpan").style.display = "block"; 
            document.querySelector(".btn-danger").style.display = "block";
        }
    }

} catch (error) {
    console.error("Error fetching validation status:", error);
}

});
