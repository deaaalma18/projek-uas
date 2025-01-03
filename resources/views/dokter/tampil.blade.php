@extends('layouts.app')

@section('content')
<div class="d-flex">
    <div class="w-100">
        <div class="container w-100">
            <h4 class="text-center mb-4">List Dokter</h4>
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.dokter.tambah') }}" class="btn btn-primary">Tambah Dokter</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali ke Beranda</a>
            </div>

            <!-- Table Section -->
            <div class="table-container mt-4">
                <table class="datatable table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Dokter</th>
                            <th>Nama Dokter</th>
                            <th>Email</th>
                            <th>Spesialis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokter as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Nomor urut -->
                                <td>{{ $data->nama_dokter }}</td> <!-- Nama dokter -->
                                <td>{{ $data->user->email ?? 'Tidak ada email' }}</td> <!-- Email -->
                                <td>{{ $data->spesialis }}</td> <!-- Spesialis -->
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.dokter.edit', $data->id_dokter) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                        <form action="{{ route('admin.dokter.delete', $data->id_dokter) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Header */
    h4 {
        font-size: 24px;
        font-weight: bold;
        color: #0A2558;
    }

    /* Styling Tombol */
    .btn-primary {
        background-color: #0A2558;
        color: white;
        border: none;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1a355e;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Styling Tabel */
    .table-container {
        margin-top: 20px;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
    }

    .thead-dark {
        background-color: #0A2558;
        color: #fff;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }

    .table-bordered {
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection