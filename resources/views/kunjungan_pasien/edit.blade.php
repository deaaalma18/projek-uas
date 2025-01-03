@extends('layouts.app')

@section('content')
    <div class="d-flex ">
        <div class="w-100">
            <div class="container w-100">
                <h4 class="text-center mb-4">
                    @if (auth()->user()->role == 'apoteker')
                        @if ($kunjungan->resep->status == 'diproses')
                            Proses Resep Obat
                        @else
                            Lihat Detail Resep
                        @endif
                    @elseif(auth()->user()->role == 'pasien')
                        Detail Kunjungan
                    @else
                        Edit Kunjungan Pasien
                    @endif
                </h4>

                <form
                    action="@if (auth()->user()->role == 'admin') {{ route('admin.kunjungan_pasien.update', $kunjungan->id_kunjungan) }} @else {{ route('dokter.kunjungan_pasien.update', $kunjungan->id_kunjungan) }} @endif"
                    method="POST" class="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_pasien" class="form-label">Pasien</label>
                        <select name="id_pasien" class="form-control" id="id_pasien"
                            @if (auth()->user()->role != 'admin') disabled @endif>
                            @foreach ($pasien as $d)
                                <option value="{{ $d->id_pasien }}"
                                    {{ $kunjungan->id_pasien == $d->id_pasien ? 'selected' : '' }}>
                                    {{ $d->nama_pasien }}
                                </option>
                            @endforeach
                        </select>
                        @if (auth()->user()->role != 'admin')
                            <input type="hidden" name="id_pasien" value="{{ $kunjungan->id_pasien }}">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="id_jadwal" class="form-label">Jadwal</label>
                        <select name="id_jadwal" class="form-control" id="id_jadwal"
                            @if (auth()->user()->role != 'admin') disabled @endif>
                            @foreach ($jadwal as $d)
                                <option value="{{ $d->id_jadwal }}"
                                    {{ $kunjungan->id_jadwal == $d->id_jadwal ? 'selected' : '' }}>
                                    {{ $d->hari_praktek }} ({{ $d->jam_mulai }}-{{ $d->jam_selesai }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_dokter" class="form-label">Dokter</label>
                        <select name="id_dokter" class="form-control" id="id_dokter"
                            @if (auth()->user()->role != 'admin') disabled @endif>
                            @foreach ($dokter as $d)
                                <option value="{{ $d->id_dokter }}"
                                    {{ $kunjungan->id_dokter == $d->id_dokter ? 'selected' : '' }}>
                                    {{ $d->nama_dokter }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" class="form-control" id="tanggal_kunjungan"
                            value="{{ $kunjungan->tanggal_kunjungan }}" @if (auth()->user()->role != 'admin') readonly @endif>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" class="form-control" id="diagnosa" @if (auth()->user()->role != 'dokter') readonly @endif>{{ $kunjungan->diagnosa }}</textarea>
                    </div>


                    @if (auth()->user()->role != 'apoteker' && auth()->user()->role != 'pasien')
                        <button class="btn btn-primary">Ubah</button>
                    @endif
                </form>
                <hr>
                @if (auth()->user()->role == 'dokter')
                <hr>
<h4 class="text-center mb-4">Riwayat Diagnosa Pasien</h4>
<div class="table-container mt-4">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Kunjungan</th>
                <th>Diagnosa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatDiagnosa as $index => $riwayat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $riwayat->tanggal_kunjungan }}</td>
                    <td>{{ $riwayat->diagnosa }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada riwayat diagnosa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
                    <h4 class="text-center mb-4">Tambah Resep</h4>

                    <form action="{{ route('dokter.kunjungan.resep', $kunjungan->id_kunjungan) }}" method="POST"
                        class="post">
                        @csrf
                        <div class="mb-3">
                            <label for="id_obat" class="form-label">Obat</label>
                            <select name="id_obat" class="form-control" id="id_obat">
                                <?php foreach($obat as $d){?>
                                <option value="<?= $d->id_obat ?>"><?= $d->nama_obat ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dosis" class="form-label">Dosis</label>
                            <input type="text" name="dosis" class="form-control" id="dosis" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <button class="btn btn-primary">Tambah Obat</button>
                    </form>
                    <hr>
                @endif
                <h4>List Obat</h4>
                <!-- Table Section -->
                <div class="table-container mt-4">
                    <table class="datatable table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Obat</th>
                                <th>Dosis</th>
                                <th>Jumlah</th>
                                @if (auth()->user()->role == 'dokter')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $no => $data)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $data->obat->nama_obat }}</td>
                                    <td>{{ $data->dosis }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    @if (auth()->user()->role == 'dokter')
                                        <td>
                                            <form action="{{ route('dokter.kunjungan.destroy_resep', $data->id_detail) }}"
                                                method="post" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h4 class="text-center mb-4">Riwayat Obat Sebelumnya</h4>
<div class="table-container mt-4">
    <table class="datatable table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Resep</th>
                <th>Nama Obat</th>
                <th>Dosis</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatObat as $riwayat)
                @foreach ($riwayat->detailResep as $index => $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->tanggal_resep }}</td>
                        <td>{{ $detail->obat->nama_obat }}</td>
                        <td>{{ $detail->dosis }}</td>
                        <td>{{ $detail->jumlah }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada riwayat obat sebelumnya.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                @if (auth()->user()->role == 'apoteker')
                    @if ($kunjungan->resep->status == 'diproses')
                        <div class="col-12">
                            <a href="{{ route('apoteker.resep_siap', $kunjungan->id_kunjungan) }}"
                                class="btn btn-success btn-block col-12 w-100">Selesai Proses Resep</a>
                        </div>
                    @endif
                @endif
            @endsection
            @push('scripts')
                <script>
                    $(document).ready(function() {
                        $('#id_dokter').on('change', function() {
                            var dokterId = $(this).val();
                            if (dokterId) {
                                $.ajax({
                                    url: 'admin/jadwal_dokter/' + dokterId,
                                    type: 'GET',
                                    success: function(response) {
                                        $('#id_jadwal').empty();
                                        response.jadwal.forEach(function(jadwal) {
                                            $('#id_jadwal').append('<option value="' + jadwal
                                                .id_jadwal + '">' + jadwal.hari_praktek + ' (' +
                                                jadwal.jam_mulai + '-' + jadwal.jam_selesai +
                                                ')</option>');
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error fetching jadwal:', error);
                                    }
                                });
                            }
                        });
                    });
                </script>
            @endpush
