<div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <a href="{{ route('pekerjaan.create') }}" class="btn btn-primary btn-sm">Tambah</a>
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
                            <th>Pekerjaan</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($query) > 0)
                            @foreach ($query as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->pekerjaan }}</td>
                                    <td>{{ $row->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('pekerjaan.edit', $row->id) }}" class="text-primary"><i
                                                style="font-size: 19px" class="bx bx-message-square-edit"></i></a>
                                        <a href="{{ route('pekerjaan.destroy', $row->id) }}"
                                            onclick="event.preventDefault();return confirm('Yakin ingin menghapus data ?') ?document.getElementById('form-delete{{ $row->id }}').submit() : null"
                                            class="text-danger"><i style="font-size: 19px"
                                                class="bx bx-trash-alt"></i></a>
                                        <form action="{{ route('pekerjaan.destroy', $row->id) }}" method="post"
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
</div>
