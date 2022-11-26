<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <a href="{{ route('keluarga.create') }}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>NO KK</th>
                            <th>Nama Keluarga</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->no_kk }}</td>
                                    <td>{{ $row->kepala_keluarga }}</td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="#" class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $loop->iteration }}"><i
                                                style="font-size: 19px" class="bx bx-info-square"></i></a>
                                        <a href="{{ route('keluarga.edit', $row->id) }}" class="text-primary"><i
                                                style="font-size: 19px" class="bx bx-message-square-edit"></i></a>
                                        <a href="{{ route('keluarga.destroy', $row->id) }}"
                                            onclick="event.preventDefault();return confirm('Yakin ingin menghapus data ?') ?document.getElementById('form-delete{{ $row->id }}').submit() : null"
                                            class="text-danger"><i style="font-size: 19px"
                                                class="bx bx-trash-alt"></i></a>
                                        <form action="{{ route('keluarga.destroy', $row->id) }}" method="post"
                                            id="form-delete{{ $row->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>


                                {{-- modal detail --}}
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Keluarga</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 style="font-weight: bold" class="text-center">
                                                            {{ $row->no_kk }}</h6>
                                                        <p class="text-center">{{ $row->kepala_keluarga }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        @foreach ($row->penduduks as $item)
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">{{ $item->nik }}
                                                                        </li>
                                                                        <li class="list-group-item">{{ $item->nama }}
                                                                        </li>
                                                                        <li class="list-group-item">{{ $item->jk }}
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            {{ $item->tempat_lahir }}
                                                                        </li>
                                                                        <li class="list-group-item">
                                                                            {{ $item->tgl_lahir }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
