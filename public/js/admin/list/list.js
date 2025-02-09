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
                item.no_disposisi.toLowerCase().includes(searchQuery)
            );
        }

        updatePagination(tabId, data);
    } catch (error) {
        // console.error("Error fetching data:", error);
    }
}

async function getDeskripsiDevisi(noDisposisi) {
    try {
        // Panggil API atau backend yang mengembalikan deskripsi_devisi berdasarkan no_disposisi
        const response = await fetch(
            `/api/get-devisi?no_disposisi=${noDisposisi}`
        );
        const data = await response.json();
        return data.deskripsi_devisi || "Tidak Diketahui";
    } catch (error) {
        console.error("Gagal mengambil deskripsi devisi:", error);
        return "Error";
    }
}

async function updatePagination(tabId, data, page = 1) {
    const itemsPerPage = 10;
    const totalPages = Math.ceil(data.length / itemsPerPage);
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, data.length);
    const paginatedData = data.slice(startIndex, endIndex);

    const listElement = document.getElementById(`surat-list-${tabId}`);
    listElement.innerHTML = "";

    for (const item of paginatedData) {
        const div = document.createElement("div");
        div.classList.add("surat-item", "p-2", "border", "rounded", "mb-2");
        div.style.display = "flex";
        div.style.flexDirection = "column";

        const topRow = document.createElement("div");
        topRow.style.display = "flex";
        topRow.style.justifyContent = "flex-start";
        topRow.style.alignItems = "center";
        topRow.style.width = "100%";
        topRow.style.gap = "10px";

        const suratText = document.createElement("span");
        suratText.textContent = item.no_disposisi;
        suratText.classList.add("fw-bold", "text-break");

        const bottomRow = document.createElement("div");
        bottomRow.style.display = "flex";
        bottomRow.style.justifyContent = "space-between";
        bottomRow.style.alignItems = "center";
        bottomRow.style.marginTop = "10px";
        bottomRow.style.width = "100%";

        const leftButtons = document.createElement("div");
        leftButtons.style.display = "flex";
        leftButtons.style.gap = "10px";

        const rightButtons = document.createElement("div");
        rightButtons.style.display = "flex";
        rightButtons.style.gap = "10px";

        const detailButton = document.createElement("button");
        detailButton.innerHTML = '<i class="fas fa-user-tie"></i>';
        detailButton.classList.add("btn", "btn-secondary", "btn-sm");
        detailButton.style.width = "auto";

        getDeskripsiDevisi(item.no_disposisi).then((deskripsi) => {
            detailButton.innerHTML = `<i class="fas fa-user-tie"></i> ${deskripsi}`;
        });

        const editButton = document.createElement("button");
        editButton.innerHTML = '<i class="fas fa-edit"></i>';
        editButton.classList.add("btn", "btn-warning", "btn-sm");
        editButton.style.width = "35px";

        const prosesButton = document.createElement("button");
        prosesButton.innerHTML = '<i class="fas fa-cogs"></i>';
        prosesButton.classList.add("btn", "btn-success", "btn-sm");
        prosesButton.style.width = "35px";

        const riwayatButton = document.createElement("button");
        riwayatButton.innerHTML = '<i class="fas fa-history"></i>';
        riwayatButton.classList.add("btn", "btn-primary", "btn-sm");
        riwayatButton.style.width = "35px";

        editButton.addEventListener("click", function () {
            if (window.editIndexUrl) {
                localStorage.setItem("no_disposisi", item.no_disposisi); // ✅ Simpan data terbaru
                console.log("No Disposisi tersimpan di localStorage:", item.no_disposisi); // 🔍 Debugging
                window.location.href =
                    window.editIndexUrl +
                    "?no_disposisi=" +
                    encodeURIComponent(item.no_disposisi);
            } else {
                console.error("Route URL untuk edit.index tidak didefinisikan.");
            }
        });
        
        prosesButton.addEventListener("click", function () {
            if (window.prosesIndexUrl) {
                localStorage.setItem("no_disposisi", item.no_disposisi); // ✅ Simpan data terbaru
                console.log("No Disposisi tersimpan di localStorage:", item.no_disposisi); // 🔍 Debugging
                window.location.href =
                    window.prosesIndexUrl +
                    "?no_disposisi=" +
                    encodeURIComponent(item.no_disposisi);
            } else {
                console.error(
                    "Route URL untuk proses.index tidak didefinisikan."
                );
            }
        });

        riwayatButton.addEventListener("click", function () {
            if (window.riwayatIndexUrl) {
                window.location.href =
                    window.riwayatIndexUrl +
                    "?no_disposisi=" +
                    encodeURIComponent(item.no_disposisi);
            } else {
                console.error(
                    "Route URL untuk riwayat.index tidak didefinisikan."
                );
            }
        });

        leftButtons.appendChild(detailButton);
        rightButtons.appendChild(editButton);
        rightButtons.appendChild(prosesButton);
        rightButtons.appendChild(riwayatButton);

        bottomRow.appendChild(leftButtons);
        bottomRow.appendChild(rightButtons);

        topRow.appendChild(suratText);

        div.appendChild(topRow);
        div.appendChild(bottomRow);

        listElement.appendChild(div);
    }

    const showingInfo = document.getElementById(`showing-info-${tabId}`);
    if (showingInfo) {
        showingInfo.textContent = `Showing ${
            startIndex + 1
        } to ${endIndex} of ${data.length} entries`;
    }

    updatePaginationControls(tabId, data, page);
}

loadData(1);
loadData(2);
