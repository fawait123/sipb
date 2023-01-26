<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    @if ($count > 0)
                        <a href="{{ route('administrasi.konfirmasi') }}?jenis={{ $jenis }}"
                            class="btn btn-primary btn-sm">Konfirmasi</a>
                    @else
                        <span>Tidak ada yang perlu di konfirmasi</span>
                    @endif
                </div>
                <div class="ms-auto">
                    <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                </div>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="table-responsive mb-3">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Asal Desa</th>
                            <th>Jenis Kelamin</th>
                            <th>Foto Penghasilan</th>
                            <th>Foto KK</th>
                            <th>Foto KTP</th>
                            <th>Status</th>
                            <th>Konfimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->desa->desa ?? '' }}</td>
                                    <td>{{ $row->jk }}</td>
                                    <td>
                                        <img src="{{ $row->foto_kk }}" width="120" class="img-thumbnail" />
                                    </td>
                                    <td>
                                        <img src="{{ $row->foto_ktp }}" width="120" class="img-thumbnail" />
                                    </td>
                                    <td>
                                        <img src="{{ $row->foto_penghasilan }}" width="120" class="img-thumbnail" />
                                    </td>
                                    <td>{{ $row->status == 'Terdaftar' ? 'Lolos' : $row->status }}</td>
                                    <td>
                                        @if ($row->status == 'Lolos')
                                            {{ $row->konfirmasi == 1 ? 'Sudah dikonfirmasi' : 'Belum dikonfirmasi' }}
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">Data tidak ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {!! $query->links() !!}
                </ul>
            </nav>
        </div>
    </div>
</div>
