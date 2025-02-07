document.querySelectorAll(".nav-link").forEach((tab) => {
    tab.addEventListener("click", function (event) {
        event.preventDefault();
        document
            .querySelectorAll(".nav-link")
            .forEach((link) => link.classList.remove("active"));
        document
            .querySelectorAll(".tab-pane")
            .forEach((content) => content.classList.remove("show", "active"));

        tab.classList.add("active");
        const target = document.querySelector(tab.getAttribute("href"));
        target.classList.add("show", "active");
    });
});

document.getElementById("search").addEventListener("input", function () {
    const searchQuery = this.value.toLowerCase();
    loadData(1, searchQuery);
    loadData(2, searchQuery);
});

async function loadData(tabId, searchQuery = "") {
    try {
        const response = await fetch(
            `/api/dispo?id_tipe=${tabId === 1 ? 100 : 200}`
        );
        let data = await response.json();

        // Filter data sesuai pencarian
        if (searchQuery) {
            data = data.filter((item) =>
                item.no_surat.toLowerCase().includes(searchQuery)
            );
        }

        updatePagination(tabId, data);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

function updatePagination(tabId, data, page = 1) {
    const itemsPerPage = 10;
    const totalPages = Math.ceil(data.length / itemsPerPage);
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, data.length);
    const paginatedData = data.slice(startIndex, endIndex);

    // Ambil container utama untuk daftar surat
    const listElement = document.getElementById(`surat-list-${tabId}`);
    listElement.innerHTML = "";

    paginatedData.forEach((item) => {
        // Container utama untuk tiap item surat
        const div = document.createElement("div");
        div.classList.add("surat-item", "p-2", "border", "rounded", "mb-2");
        div.style.display = "flex";
        div.style.flexDirection = "column";

        // --- Top Row: Tombol Direktur dan No Surat (rata kiri) ---
        const topRow = document.createElement("div");
        topRow.style.display = "flex";
        topRow.style.justifyContent = "flex-start"; // elemen rata kiri
        topRow.style.alignItems = "center";
        topRow.style.width = "100%";
        topRow.style.gap = "10px"; // jarak antara tombol dan teks

        // Tombol "Direktur"
        const detailButton = document.createElement("button");
        detailButton.textContent = "Direktur";
        detailButton.classList.add("btn", "btn-secondary", "btn-sm");
        detailButton.style.width = "max-content";
        detailButton.style.padding = "2px 6px";

        // Elemen teks no surat
        const suratText = document.createElement("span");
        suratText.textContent = item.no_surat;
        suratText.classList.add("fw-bold", "text-break");

        // Urutan: tombol Direktur, kemudian no surat
        topRow.appendChild(detailButton);
        topRow.appendChild(suratText);

        // --- Bottom Row: Tombol Proses dan Riwayat (rata kanan) ---
        const bottomRow = document.createElement("div");
        bottomRow.style.display = "flex";
        bottomRow.style.justifyContent = "flex-end"; // tombol rata kanan
        bottomRow.style.alignItems = "center";
        bottomRow.style.marginTop = "10px"; // jarak antara top row dan bottom row
        bottomRow.style.gap = "10px"; // jarak antar tombol
        bottomRow.style.width = "100%";

        // Tombol "Proses"
        const actionButton = document.createElement("button");
        actionButton.textContent = "Proses";
        actionButton.classList.add("btn", "btn-success", "btn-sm");
        actionButton.style.width = "auto";

        // Tombol "Riwayat"
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Riwayat";
        deleteButton.classList.add("btn", "btn-primary", "btn-sm");
        deleteButton.style.width = "auto";

        // Masukkan tombol-tombol ke dalam bottomRow
        bottomRow.appendChild(actionButton);
        bottomRow.appendChild(deleteButton);

        // Gabungkan topRow dan bottomRow ke dalam container utama
        div.appendChild(topRow);
        div.appendChild(bottomRow);

        // Tambahkan container utama ke listElement
        listElement.appendChild(div);
    });

    // Update informasi jumlah data yang tampil (jika elemen tersebut ada)
    const showingInfo = document.getElementById(`showing-info-${tabId}`);
    if (showingInfo) {
        showingInfo.textContent = `Showing ${startIndex + 1} to ${endIndex} of ${data.length} entries`;
    }

    updatePaginationControls(tabId, data, page);
}






// Fungsi hapus data
// async function deleteItem(id, tabId) {
//     if (!confirm("Apakah Anda yakin ingin menghapus surat ini?")) return;

//     try {
//         const response = await fetch(`/api/dispo/${id}`, { method: "DELETE" });
//         if (response.ok) {
//             alert("Surat berhasil dihapus.");
//             loadData(tabId);
//         } else {
//             alert("Gagal menghapus surat.");
//         }
//     } catch (error) {
//         console.error("Error deleting data:", error);
//     }
// }

// Panggil data saat pertama kali halaman dimuat
loadData(1);
loadData(2);

