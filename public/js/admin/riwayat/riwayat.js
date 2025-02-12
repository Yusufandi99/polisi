document.addEventListener("DOMContentLoaded", async function () {
    const params = new URLSearchParams(window.location.search);
    const queryNoSurat = params.get("no_disposisi");

    if (queryNoSurat) {
        localStorage.setItem("no_disposisi", queryNoSurat);

        window.history.replaceState(
            {},
            document.title,
            window.location.pathname
        );
    }

    const storedNoSurat = localStorage.getItem("no_disposisi");
    const displayElement = document.querySelector("#no-surat-display b");
    if (displayElement) {
        displayElement.textContent = storedNoSurat
            ? storedNoSurat
            : "Tidak ada";
    }

    if (!storedNoSurat) {
        console.error("No disposisi tidak ditemukan.");
        return;
    }

    try {
        const response = await fetch(
            `/api/get-tracking?no_disposisi=${storedNoSurat}`
        );
        const data = await response.json();

        if (!data || data.length === 0) {
            console.error("Data tracking tidak ditemukan.");
            return;
        }

        const trackingContainer = document.querySelector(".tracking-container");

        trackingContainer.innerHTML = "";

        data.forEach((item) => {
            const step = document.createElement("div");
            step.classList.add("tracking-step");
            console.log("Data tracking:", data);

            step.innerHTML = `
                <div class="tracking-circle">✔</div>
                <div class="tracking-content">
                    <div class="tracking-text">${item.uraian}</div>
                    <div class="tracking-date">${item.waktu_trans}</div>
                </div>
            `;
            trackingContainer.appendChild(step);
        });
    } catch (error) {
        console.error("Error fetching tracking data:", error);
    }
});

document.addEventListener("DOMContentLoaded", async function () {
    const params = new URLSearchParams(window.location.search);
    const queryNoSurat = params.get("no_disposisi");

    if (queryNoSurat) {
        localStorage.setItem("no_disposisi", queryNoSurat);
        window.history.replaceState(
            {},
            document.title,
            window.location.pathname
        );
    }

    const storedNoSurat = localStorage.getItem("no_disposisi");

    const displayElement = document.querySelector("#no-surat-display b");
    if (displayElement) {
        displayElement.textContent = storedNoSurat
            ? storedNoSurat
            : "Tidak ada";
    }

    if (!storedNoSurat) {
        console.error("No disposisi tidak ditemukan.");
        return;
    }

    try {
        const dispoResponse = await fetch(
            `/api/get-dispo?no_disposisi=${storedNoSurat}`
        );
        const dispoData = await dispoResponse.json();

        console.log("Data dispo:", dispoData);

        if (dispoData) {    
            document.querySelector("#kepada-display").textContent =
                dispoData.kepada || "Tidak ada data";
            document.querySelector("#no_surat").textContent =
                dispoData.no_surat || "Tidak ada petugas";
            document.querySelector("#petugas").textContent =
                dispoData.nama_petugas || "Tidak ada petugas";
            document.querySelector("#devisi").textContent =
                dispoData.deskripsi_devisi || "Tidak ada devisi";
        } else {
            console.error("Data dispo tidak ditemukan atau kosong.");
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
});
