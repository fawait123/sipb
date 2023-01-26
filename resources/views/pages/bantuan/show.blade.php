@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('pkh.update', $pkh->id) : route('bantuan.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <input type="hidden" name="jenis" value="">
                <div class="form-group">
                    <label for="no_surat">Nomor Surat</label>
                    <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                        placeholder="no_surat" value="{{ $bantuan->no_surat }}" disabled>
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" name="tgl_pengajuan"
                        class="form-control @error('tgl_pengajuan') is-invalid @enderror" placeholder="tgl_pengajuan"
                        value="{{ $bantuan->no_surat }}" disabled>
                    @error('tgl_pengajuan')
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
                            @foreach ($bantuan->detail as $item)
                                <tr>
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
                                        <span>{{ $item->status_pengajuan == 'Terdaftar' ? 'Lolos' : $item->status }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
