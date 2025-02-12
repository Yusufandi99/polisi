@extends('admin.layout.master')

@section('isi')
<div class="container">
    <h1 class="text-center"> Tracking Disposisi</h1>
    <br>
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

    <div style="overflow-x: auto;">
        <table id="dispoTable" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No Disposisi</th>
                    <th>Nama Petugas</th>
                    <th>Waktu Transaksi</th>
                    <th>Uraian</th>
                    <th>Status</th>
                    <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row->no_disposisi }}</td>
                        <td>{{ $row->nama_petugas }}</td>
                        <td>{{ $row->waktu_trans }}</td>
                        <td>{{ $row->uraian }}</td>
                        <td>{{ $row->deskripsi_status }}</td>
                        <td>
                            <form action="{{ route('tracking.destroy', ['no_disposisi' => base64_encode($row->no_disposisi), 'waktu_trans' => base64_encode($row->waktu_trans)]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#dispoTable').DataTable({
            "scrollX": true,  
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>

@endsection
