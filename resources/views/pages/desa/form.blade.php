@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('desa.update', $desa->id) : route('desa.store') }}" method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="kabupaten">kabupaten</label>
                    <select name="kabupaten" id="kabupaten" class="form-control @error('kabupaten') ? is-invalid @enderror">
                        <option value="">pilih</option>
                        @foreach ($kabupaten as $item)
                            <option value="{{ $item->id }}"
                                {{ (isset($id) ? $id : old('kabupaten')) == $item->id ? 'selected' : '' }}>
                                {{ $item->kabupaten }}</option>
                        @endforeach
                    </select>
                    @error('kabupaten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control @error('kecamatan') ? is-invalid @enderror">
                        <option value="">pilih</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}"
                                {{ (isset($id) ? $id : old('kecamatan')) == $item->id ? 'selected' : '' }}>
                                {{ $item->kecamatan }}</option>
                        @endforeach
                    </select>
                    @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desa">desa</label>
                    <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror"
                        placeholder="desa" value="{{ isset($id) ? $desa->desa : old('desa') }}">
                    @error('desa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
