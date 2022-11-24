@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('kecamatan.update', $kecamatan->id) : route('kecamatan.store') }}"
                method="post">
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
                    <label for="kecamatan">kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                        placeholder="kecamatan" value="{{ isset($id) ? $kecamatan->kecamatan : old('kecamatan') }}">
                    @error('kecamatan')
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
