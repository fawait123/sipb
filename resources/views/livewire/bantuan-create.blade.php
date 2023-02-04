<div>
    <div class="card radius-10">
        <div class="card-body">
            @if (count($pendaftaran) > 0)
                <form action="{{ isset($id) ? route('pkh.update', $pkh->id) : route('bantuan.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($id))
                        @method('put')
                    @endif
                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        <input type="text" name="no_surat"
                            class="form-control @error('no_surat') is-invalid @enderror" placeholder="no_surat"
                            value="{{ isset($id) ? $pkh->no_surat : old('no_surat') }}"
                            {{ isset($id) ? 'disabled' : '' }}>
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                        <input type="date" name="tgl_pengajuan"
                            class="form-control @error('tgl_pengajuan') is-invalid @enderror"
                            placeholder="tgl_pengajuan"
                            value="{{ isset($id) ? $pkh->tgl_pengajuan : old('tgl_pengajuan') }}">
                        @error('tgl_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_surat">File</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                            placeholder="file" value="{{ isset($id) ? $pkh->file : old('file') }}"
                            {{ isset($id) ? 'disabled' : '' }}>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="data" value="{{ isset($id) ? json_encode($data) : old('data') }}">
                    {{-- <button type="button" class="btn btn-dark btn-sm mt-3" data-bs-toggle="modal"
                        data-bs-target="#exampleVerticallycenteredModal">Tambah Penduduk</button> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Asal Desa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>KTP</th>
                                    <th>Penghasilan</th>
                                    <th>KK</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($pendaftaran as $item)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                                        <td>{{ $item->penduduk->nik ?? '' }}</td>
                                        <td>{{ $item->penduduk->nama ?? '' }}</td>
                                        <td>{{ $item->penduduk->desa->desa ?? '' }}</td>
                                        <td>{{ $item->penduduk->jk ?? '' }}</td>
                                        <td>{{ $item->penduduk->agama->agama ?? '' }}</td>
                                        <td>
                                            <a href="{{ $item->foto_ktp }}" target="blank">Foto KTP</a>
                                        </td>
                                        <td>
                                            <a href="{{ $item->foto_penghasilan }}" target="blank">Foto Penghasilan</a>
                                        </td>
                                        <td>
                                            <a href="{{ $item->foto_kk }}" target="blank">Foto KK</a>
                                        </td>
                                        <td>
                                            <span>{{ $item->status == 'Terdaftar' ? 'Lolos' : $item->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit"
                            class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                    </div>
                </form>
            @else
                <h1>Tidak ada pendaftaran yang ditemukan</h1>
            @endif
        </div>
    </div>
</div>
