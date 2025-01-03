@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="text-center mb-4">List Resep Obat</h4>

        <!-- Tabel Resep Belum Selesai -->
        <h5>Resep Belum Selesai</h5>
        <div class="table-container mt-4">
            <table class="datatable table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Resep</th>
                        <th>Dokter</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Resep</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resepDiproses as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->dokter->nama_dokter }}</td>
                            <td>{{ $data->kunjunganPasien->pasien->nama_pasien ?? '-' }}</td>
                            <td>{{ $data->tanggal_resep }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <a href="{{ route('apoteker.resep.edit', $data->kunjunganPasien->id_kunjungan) }}"
                                    class="btn btn-sm btn-primary">Proses</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Resep Selesai -->
        <h5 class="mt-5">Resep Selesai</h5>
        <div class="table-container mt-4">
            <table class="datatable table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Resep</th>
                        <th>Dokter</th>
                        <th>Nama Pasien</th>
                        <th>Tanggal Resep</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resepSelesai as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->dokter->nama_dokter }}</td>
                            <td>{{ $data->kunjunganPasien->pasien->nama_pasien ?? '-' }}</td>
                            <td>{{ $data->tanggal_resep }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <a href="{{ route('apoteker.resep.edit', $data->kunjunganPasien->id_kunjungan) }}"
                                    class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
