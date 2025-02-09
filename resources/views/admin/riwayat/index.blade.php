@extends('admin.layout.master')

@section('isi')
<div class="container" id="container">
    <main>
    <a href="{{ route('list.index') }}" class="btn btn-secondary mb-3">&#x2B05; Kembali</a>
        <div class="detail-title"><b style="font-size: 24px;">Detail Informasi Surat</b></div><br>
        <table width="100%">
            <tr>
                <table width="100%">
                    <tr>
                        <td id="no-surat-display" style="white-space: nowrap;">
                            No Surat: <b></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="white-space: nowrap;">FROM: <b id="kepada-display"></b> </td>
                    </tr>
                    <tr>
                        <td style="white-space: nowrap;">Nama Petugas: <b id="petugas"></b> </td>
                    </tr>
                    <tr>
                        <td style="white-space: nowrap;">Devisi: <b id="devisi"></b> </td>
                    </tr>

                </table>

            </tr>
        </table><br>
        <div class="tracking-container">
            <!-- <div class="tracking-step"> -->
            <!-- <div class="tracking-circle"></div> -->
            <!-- <div class="tracking-content"> -->
            <div class="tracking-text"></div>
            <div class="tracking-date"></div>
            <!-- </div> -->
        </div>
</div>

</main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", async function() {

        const params = new URLSearchParams(window.location.search);
        const queryNoSurat = params.get('no_disposisi');


        if (queryNoSurat) {
            localStorage.setItem('no_disposisi', queryNoSurat);

            window.history.replaceState({}, document.title, window.location.pathname);
        }

        const storedNoSurat = localStorage.getItem('no_disposisi');
        const displayElement = document.querySelector("#no-surat-display b");
        if (displayElement) {
            displayElement.textContent = storedNoSurat ? storedNoSurat : "Tidak ada";
        }


        if (!storedNoSurat) {
            console.error("No disposisi tidak ditemukan.");
            return;
        }

        try {

            const response = await fetch(`/api/get-tracking?no_disposisi=${storedNoSurat}`);
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
</script>

<script>
    document.addEventListener("DOMContentLoaded", async function() {
        const params = new URLSearchParams(window.location.search);
        const queryNoSurat = params.get('no_disposisi');

        if (queryNoSurat) {
            localStorage.setItem('no_disposisi', queryNoSurat);
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        const storedNoSurat = localStorage.getItem('no_disposisi');

        const displayElement = document.querySelector("#no-surat-display b");
        if (displayElement) {
            displayElement.textContent = storedNoSurat ? storedNoSurat : "Tidak ada";
        }

        if (!storedNoSurat) {
            console.error("No disposisi tidak ditemukan.");
            return;
        }

        try {

            const dispoResponse = await fetch(`/api/get-dispo?no_disposisi=${storedNoSurat}`);
            const dispoData = await dispoResponse.json();

            // console.log("Data dispo:", dispoData);

            if (dispoData) {
                document.querySelector("#kepada-display").textContent = dispoData.kepada || "Tidak ada data";
                document.querySelector("#petugas").textContent = dispoData.nama_petugas || "Tidak ada petugas";
                document.querySelector("#devisi").textContent = dispoData.deskripsi_devisi || "Tidak ada devisi";
            } else {
                console.error("Data dispo tidak ditemukan atau kosong.");
            }


        } catch (error) {
            console.error("Error fetching data:", error);
        }
    });
</script>


@endsection