@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('pkh.verify', $pkh->id) : route('pkh.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="no_surat">Nomor Surat</label>
                    <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                        placeholder="no_surat" value="{{ isset($id) ? $pkh->no_surat : old('no_surat') }}"
                        {{ isset($id) ? 'disabled' : '' }}>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" name="tgl_pengajuan"
                        class="form-control @error('tgl_pengajuan') is-invalid @enderror" placeholder="tgl_pengajuan"
                        value="{{ isset($id) ? $pkh->tgl_pengajuan : old('tgl_pengajuan') }}" disabled>
                    @error('tgl_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="data" value="{{ isset($id) ? json_encode($data) : old('data') }}">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Status</th>
                                <th>Kewarganegaraan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                {{-- <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                </div> --}}
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true" data-focus="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="form-group">
                            <label class="form-label">Pilih Penduduk</label>
                            <select class="single-select2" name="penduduk">
                                <option value="">pilih</option>
                                @foreach ($penduduk as $item)
                                    <option value="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                        data-tempat_lahir="{{ $item->tempat_lahir }}"
                                        data-tgl_lahir="{{ $item->tgl_lahir }}" data-jk="{{ $item->jk }}"
                                        data-agama="{{ $item->agama->agama }}"
                                        data-status_kawin="{{ $item->status_kawin }}"
                                        data-kewarganegaraan="{{ $item->kewarganegaraan }}">
                                        {{ $item->nik . ' ' . $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customjs')
    <script>
        $(document).ready(function() {
            // chek all
            $("input[type='checkbox']").change(function() {
                let nik = $(this).data('nik')
                console.log(nik)
                // $.ajax({
                //     url: '{{ route('pkh.bagikan.aksi') }}',
                //     method: 'get',
                //     data: {
                //         id_penduduk: nik,
                //         id: '{{ $id }}'
                //     },
                //     success: function(res) {
                //         console.log(res)
                //         $(this).prop('checked', true);
                //         checkAll(data)
                //         window.location.reload();
                //         let findIndex = data.findIndex((el) => el.id === nik)
                //         data[findIndex].status = 'Sudah Disalurkan'
                //         data[findIndex].check = true
                //     }
                // })
            })
        })
    </script>
@endpush
