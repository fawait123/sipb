<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <a href="{{ route('penduduk.create') }}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>NIK</th>
                            <th>Nama Penduduk</th>
                            <th>Kewarganegaraan</th>
                            <th>Status Kawin</th>
                            <th>Desa</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nik }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->kewarganegaraan }}</td>
                                    <td>{{ $row->status_kawin }}</td>
                                    <td>{{ $row->desa->desa }}</td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="#" class="text-warning modal-detail" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-nik="{{ $row->nik }}"
                                            data-nama="{{ $row->nama }}"
                                            data-tempat_lahir="{{ $row->tempat_lahir }}" data-jk="{{ $row->jk }}"
                                            data-status_kawin="{{ $row->status_kawin }}"
                                            data-kewarganegaraan="{{ $row->kewarganegaraan }}"
                                            data-goldar="{{ $row->goldar }}" data-nama_ibu="{{ $row->nama_ibu }}"
                                            data-nama_ayah="{{ $row->nama_ayah }}"
                                            data-pendidikan_terakhir="{{ $row->pendidikan_terakhir }}"
                                            data-created_at="{{ $row->created_at->diffForHumans() }}"
                                            data-agama="{{ $row->agama ? $row->agama->agama : null }}"
                                            data-desa="{{ $row->desa->desa }}"
                                            data-kecamatan="{{ $row->desa->kecamatan->kecamatan ?? '' }}"
                                            data-kabupaten="{{ $row->desa->kecamatan->kabupaten->kabupaten ?? '' }}"
                                            data-pekerjaan="{{ $row->pekerjaan->pekerjaan ?? null }}"
                                            data-keluarga="{{ $row->keluarga->keluarga ?? null }}"
                                            data-alamat="{{ $row->alamat }}"
                                            data-tgl_lahir="{{ date('d M Y', strtotime($row->tgl_lahir)) }}"><i
                                                style="font-size: 19px" class="bx bx-info-square"></i></a>
                                        <a href="{{ route('penduduk.edit', $row->id) }}" class="text-primary"><i
                                                style="font-size: 19px" class="bx bx-message-square-edit"></i></a>
                                        <a href="{{ route('penduduk.destroy', $row->id) }}"
                                            onclick="event.preventDefault();return confirm('Yakin ingin menghapus data ?') ?document.getElementById('form-delete{{ $row->id }}').submit() : null"
                                            class="text-danger"><i style="font-size: 19px"
                                                class="bx bx-trash-alt"></i></a>
                                        <form action="{{ route('penduduk.destroy', $row->id) }}" method="post"
                                            id="form-delete{{ $row->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="list-group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('customjs')
        <script>
            $('#exampleModal').on('show.bs.modal', function(event) {
                let target = $(event.relatedTarget) // Button triggered the modal
                let obj = {
                    nik: $(target).data('nik'),
                    keluarga: $(target).data('keluarga'),
                    nama: $(target).data('nama'),
                    tempat_lahir: $(target).data('tempat_lahir'),
                    tgl_lahir: $(target).data('tgl_lahir'),
                    jenis_kelamin: $(target).data('jk'),
                    alamat: $(target).data('alamat'),
                    status_kawin: $(target).data('status_kawin'),
                    kewarganegaraan: $(target).data('kewarganegaraan'),
                    goldar: $(target).data('goldar'),
                    nama_ibu: $(target).data('nama_ibu'),
                    nama_ayah: $(target).data('nama_ayah'),
                    pendidikan_terakhir: $(target).data('pendidikan_terakhir'),
                    agama: $(target).data('agama'),
                    pekerjaan: $(target).data('pekerjaan'),
                    desa: $(target).data('desa'),
                    kecamatan: $(target).data('kecamatan'),
                    kabupaten: $(target).data('kabupaten'),
                    dibuat: $(target).data('created_at'),
                }
                let data = Object.keys(obj)
                let list = ''
                data.map((val, index) => {
                    list +=
                        `<div class="col-5 mb-2">
                            <span style="font-weight: bold; text-transform:capitalize">${data[index].split('_').join(' ')}</span>
                        </div>
                        <div class="col-7">
                            <span  style="text-transform:capitalize">: ${obj[val] == "" || null ? 'Tidak diketahui' : obj[val]}</span>
                        </div>`
                })

                $("#list-group").html(list)
            })
        </script>
    @endpush
</div>
