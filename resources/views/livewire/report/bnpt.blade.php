<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <button class="btn btn-primary btn-sm" wire:click="download">Download</button>
                </div>
                <div class="ms-auto">
                    <div class="form-group">
                        <label for="no_surat">Cari</label>
                        <input type="text" class="form-control" wire:model="search" placeholder="Cari...">
                    </div>
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
                            <th>No</th>
                            <th>Jenis</th>
                            <th>No Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Penerimaan</th>
                            <th>Status Pengajuan</th>
                            <th>Nama Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->bantuan->jenis->nama_bantuan ?? '' }}</td>
                                    <td>{{ $row->bantuan->no_surat ?? '' }}</td>
                                    <td>{{ $row->bantuan->tgl_pengajuan ?? '' }}</td>
                                    <td>{{ $row->bantuan->tgl_penerimaan ?? '' }}</td>
                                    <td>{{ $row->status_pengajuan ?? '' }}</td>
                                    <td>{{ $row->penduduk->nama ?? '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" align="center">Data tidak ditemukan</td>
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
