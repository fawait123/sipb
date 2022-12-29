@extends('layouts.app')

@section('content')
    @if ($pendaftaran)
        <h1>halaman timeline</h1>
    @else
        {{-- check umur dan penghasilan --}}
        @if (count($umur) > 18250 || $penduduk->penghasilan <= 1500000)
            <div class="card radius-10">
                <div class="card-body">
                    <form action="{{ isset($id) ? route('bpnt.update', $bpnt->id) : route('pendaftaran.store') }}"
                        method="post">
                        @csrf
                        @if (isset($id))
                            @method('put')
                        @endif
                        <input type="hidden" value="{{ $penduduk->id }}" name="id_penduduk">
                        <div class="form-group">
                            <label for="id_desa">Desa</label>
                            <select name="id_desa" id="id_desa"
                                class="form-control @error('id_desa') is-invalid @enderror">
                                <option value="">pilih</option>
                                @foreach ($desa as $item)
                                    <option value="{{ $item->id }}">{{ $item->desa }}</option>
                                @endforeach
                            </select>
                            @error('id_desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_jenis_bantuan">Jenis Bantuan</label>
                            <select name="id_jenis_bantuan" id="id_jenis_bantuan"
                                class="form-control @error('id_jenis_bantuan') is-invalid @enderror">
                                <option value="">pilih</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_bantuan }}</option>
                                @endforeach
                            </select>
                            @error('id_jenis_bantuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-sm">Daftar Bantuan</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card radius-10">
                <div class="card-body">
                    <h1>Anda tidak berhak mendapatkan bantuan</h1>
                </div>
            </div>
        @endif
    @endif
@endsection
