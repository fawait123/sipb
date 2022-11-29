@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('bnpt.verify', $bnpt->id) : route('bnpt.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="no_surat">Nomor Surat</label>
                    <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                        placeholder="no_surat" value="{{ isset($id) ? $bnpt->no_surat : old('no_surat') }}"
                        {{ isset($id) ? 'disabled' : '' }}>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" name="tgl_pengajuan"
                        class="form-control @error('tgl_pengajuan') is-invalid @enderror" placeholder="tgl_pengajuan"
                        value="{{ isset($id) ? $bnpt->tgl_pengajuan : old('tgl_pengajuan') }}" disabled>
                    @error('tgl_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="data" value="{{ isset($id) ? json_encode($data) : old('data') }}">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Status</th>
                                <th>Kewarganegaraan</th>
                                <th>Diverifikasi oleh</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
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
        let data = [];
        let dataPenduduk = $("input[name='data']").val()
        dataPenduduk = JSON.parse(dataPenduduk)
        // data = dataPenduduk
        dataPenduduk.map((el, index) => {
            data.push({
                ...el,
                check: false
            })
            tbody += `
                    <tr>
                                    <td>${el.nik}</td>
                                    <td>${el.nama}</td>
                                    <td>${el.tempat_lahir + ' '+el.tgl_lahir}</td>
                                    <td>${el.jk}</td>
                                    <td>${el.agama}</td>
                                    <td>${el.status_kawin}</td>
                                    <td>${el.kewarganegaraan}</td>
                                    <td>${el.verifikator}</td>
                                    <td>${el.status === 'Ditolak' ? '<span class="badge bg-danger">'+el.status+'</span>':'<span class="badge bg-primary">'+el.status+'</span>'}</td>
                                </tr>
                    `;
        })

        $("#tbody").html(tbody)
    </script>
@endpush
