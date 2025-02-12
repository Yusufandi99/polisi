@extends('admin.layout.master')

@section('isi')
<div class="container" id="container">
    <main>
        <a href="{{ route('list.index') }}" class="btn btn-secondary mb-3">&#x2B05; Kembali</a>
        <div class="detail-title"><b style="font-size: 24px;">Detail Informasi Surat</b></div><br>
        <table width="100%">
            <tr>

                <table class="table table-striped table-bordered" style="width: 100%;">
                    <tr>
                        <td style="font-weight: bold;">No Disposisi</td>
                        <td id="no-surat-display" style="white-space: nowrap;">
                            <b></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">No Surat</td>
                        <td id="no_surat" style="white-space: nowrap;">
                            <b></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">FROM</td>
                        <td id="kepada-display"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Nama Petugas</td>
                        <td id="petugas"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Devisi</td>
                        <td id="devisi"></td>
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
<script src="{{ asset('js/admin/riwayat/riwayat.js') }}"></script>

@endsection