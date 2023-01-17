<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <a href="{{ route('pkh.create') }}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>No</th>
                            <th>Jenis Bantuan</th>
                            <th>No Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Diajukan oleh</th>
                            <th>Keterangan</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->jenis->nama_bantuan }}</td>
                                    <td>{{ $row->no_surat }}</td>
                                    <td>{{ $row->tgl_pengajuan }}</td>
                                    <td>{{ $row->userInput->nama }}</td>
                                    <td>{{ $row->keterangan_bantuan }}</td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if (auth()->user()->jabatan == 'admin kabupaten 1' && $row->step == 1)
                                            <a href="{{ route('pkh.form.verify', $row->id) }}" class="text-warning"><i
                                                    style="font-size: 19px" class="bx bx-donate-blood"></i></a>
                                        @endif
                                        @if (auth()->user()->jabatan == 'admin kabupaten' && $row->step == 1)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->iteration }}"
                                                class="text-warning"><i style="font-size: 19px"
                                                    class="bx bx-badge-check"></i></a>
                                        @endif
                                        @if (auth()->user()->jabatan == 'admin kecamatan' && ($row->step == 2 || $row->step == 0))
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->iteration }}"
                                                class="text-warning"><i style="font-size: 19px"
                                                    class="bx bx-badge-check"></i></a>
                                        @endif
                                        @if ($row->status == 'Diajukan' && auth()->user()->jabatan == 'admin desa')
                                            <a href="{{ route('pkh.edit', $row->id) }}" class="text-primary"><i
                                                    style="font-size: 19px" class="bx bx-message-square-edit"></i></a>
                                            <a href="{{ route('pkh.destroy', $row->id) }}"
                                                onclick="event.preventDefault();return confirm('Yakin ingin menghapus data ?') ?document.getElementById('form-delete{{ $row->id }}').submit() : null"
                                                class="text-danger"><i style="font-size: 19px"
                                                    class="bx bx-trash-alt"></i></a>
                                            <form action="{{ route('pkh.destroy', $row->id) }}" method="post"
                                                id="form-delete{{ $row->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endif
                                        @if (auth()->user()->jabatan == 'admin desa' && $row->step == 3)
                                            <a href="{{ route('pkh.bagikan', $row->id) }}" class="text-dark"><i
                                                    style="font-size: 19px" class="bx bx-donate-blood"></i></a>
                                        @endif
                                        <a href="{{ route('pkh.show', $row->id) }}" class="text-success"><i
                                                style="font-size: 19px" class="bx bx-info-square"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('pkh.konfirmasi', $row->id) }}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi Bantuan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin ingin konfirmasi bantuan ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tidak</button>
                                                    <button type="submit" class="btn btn-primary">Ya</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
