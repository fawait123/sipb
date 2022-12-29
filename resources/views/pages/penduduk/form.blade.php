@extends('layouts.app')

@section('content')
    <form action="{{ isset($id) ? route('penduduk.update', $penduduk->id) : route('penduduk.store') }}" method="post">
        @csrf
        @if (isset($id))
            @method('put')
        @endif
        <div class="row">
            <div class="col-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="nik" value="{{ isset($id) ? $penduduk->nik : old('nik') }}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="tempat_lahir"
                                value="{{ isset($id) ? $penduduk->tempat_lahir : old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror">
                                <option value="">pilih</option>
                                <option value="laki-laki"
                                    {{ (isset($id) && $penduduk->jk == 'laki-laki' ? 'selected' : old('jk') == 'laki-laki') ? 'selected' : '' }}>
                                    Laki Laki</option>
                                <option value="perempuan"
                                    {{ (isset($id) && $penduduk->jk == 'perempuan' ? 'selected' : old('jk') == 'perempuan') ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror">
                                <option value="">pilih</option>
                                @foreach ($agama as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (isset($id) && $penduduk->id_agama == $item->id ? 'selected' : old('agama') == $item->id) ? 'selected' : '' }}>
                                        {{ $item->agama }}</option>
                                @endforeach
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_kawin">Status Kawin</label>
                            <select name="status_kawin" id="status_kawin"
                                class="form-control @error('status_kawin') is-invalid @enderror">
                                <option value="">pilih</option>
                                <option value="kawin"
                                    {{ (isset($id) && $penduduk->status_kawin == 'kawin' ? 'selected' : old('status_kawin') == 'kawin') ? 'selected' : '' }}>
                                    Kawin</option>
                                <option value="belum kawin"
                                    {{ (isset($id) && $penduduk->status_kawin == 'belum kawin' ? 'selected' : old('status_kawin') == 'belum kawin') ? 'selected' : '' }}>
                                    Belum Kawin</option>
                            </select>
                            @error('status_kawin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan"
                                class="form-control @error('pekerjaan') is-invalid @enderror">
                                <option value="">pilih</option>
                                @foreach ($pekerjaan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (isset($id) && $penduduk->id_pekerjaan == $item->id ? 'selected' : old('pekerjaan') == $item->id) ? 'selected' : '' }}>
                                        {{ $item->pekerjaan }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penghasilan">Penghasilan</label>
                            <input type="number" name="penghasilan"
                                class="form-control @error('penghasilan') is-invalid @enderror" placeholder="penghasilan"
                                value="{{ isset($id) ? $penduduk->penghasilan : old('penghasilan') }}">
                            @error('penghasilan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <select name="kewarganegaraan" id="kewarganegaraan"
                                class="form-control @error('kewarganegaraan') is-invalid @enderror">
                                <option value="">pilih</option>
                                <option value="WNI"
                                    {{ (isset($id) && $penduduk->kewarganegaraan == 'WNI' ? 'selected' : old('kewarganegaraan') == 'WNI') ? 'selected' : '' }}>
                                    WNI</option>
                                <option value="WNA"
                                    {{ (isset($id) && $penduduk->kewarganegaraan == 'WNA' ? 'selected' : old('kewarganegaraan') == 'WNA') ? 'selected' : '' }}>
                                    WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="goldar">Golongan Darah</label>
                            <select name="goldar" id="goldar"
                                class="form-control @error('goldar') is-invalid @enderror">
                                <option value="">pilih</option>
                                <option value="A"
                                    {{ (isset($id) && $penduduk->goldar == 'A' ? 'selected' : old('goldar') == 'A') ? 'selected' : '' }}>
                                    A</option>
                                <option value="AB"
                                    {{ (isset($id) && $penduduk->goldar == 'AB' ? 'selected' : old('goldar') == 'AB') ? 'selected' : '' }}>
                                    AB</option>
                                <option value="O"
                                    {{ (isset($id) && $penduduk->goldar == 'O' ? 'selected' : old('goldar') == 'O') ? 'selected' : '' }}>
                                    O</option>
                                <option value="Tidak Tahu"
                                    {{ (isset($id) && $penduduk->goldar == 'Tidak Tahu' ? 'selected' : old('goldar') == 'Tidak Tahu') ? 'selected' : '' }}>
                                    Tidak Tahu</option>
                            </select>
                            @error('goldar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desa">desa</label>
                            <select name="desa" id="desa" class="form-control @error('desa') is-invalid @enderror">
                                <option value="">pilih</option>
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (isset($id) && $penduduk->id_desa == $item->id ? 'selected' : old('desa') == $item->id) ? 'selected' : '' }}>
                                        {{ $item->desa }}</option>
                                @endforeach
                            </select>
                            @error('desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="nama" value="{{ isset($id) ? $penduduk->nama : old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                cols="10" rows="10">{{ isset($id) ? $penduduk->alamat : old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir"
                                class="form-control @error('tgl_lahir') is-invalid @enderror" placeholder="tgl_lahir"
                                value="{{ isset($id) ? $penduduk->tgl_lahir : old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" name="nama_ibu"
                                class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="nama_ibu"
                                value="{{ isset($id) ? $penduduk->nama_ibu : old('nama_ibu') }}">
                            @error('nama_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah"
                                class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="nama_ayah"
                                value="{{ isset($id) ? $penduduk->nama_ayah : old('nama_ayah') }}">
                            @error('nama_ayah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                <option value="">pilih</option>
                                <option value="SD"
                                    {{ (isset($id) && $penduduk->pendidikan_terakhir == 'SD' ? 'selected' : old('pendidikan_terakhir') == 'SD') ? 'selected' : '' }}>
                                    SD</option>
                                <option value="SMP"
                                    {{ (isset($id) && $penduduk->pendidikan_terakhir == 'SMP' ? 'selected' : old('pendidikan_terakhir') == 'SMP') ? 'selected' : '' }}>
                                    SMP</option>
                                <option value="SMA"
                                    {{ (isset($id) && $penduduk->pendidikan_terakhir == 'SMA' ? 'selected' : old('pendidikan_terakhir') == 'SMA') ? 'selected' : '' }}>
                                    SMA</option>
                                <option value="Sarjana"
                                    {{ (isset($id) && $penduduk->pendidikan_terakhir == 'Sarjana' ? 'selected' : old('pendidikan_terakhir') == 'Sarjana') ? 'selected' : '' }}>
                                    Sarjana</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit"
                                class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
