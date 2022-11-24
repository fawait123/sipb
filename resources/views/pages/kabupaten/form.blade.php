@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('kabupaten.update', $kabupaten->id) : route('kabupaten.store') }}"
                method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="kabupaten">Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror"
                        placeholder="kabupaten" value="{{ isset($id) ? $kabupaten->kabupaten : old('kabupaten') }}">
                    @error('kabupaten')
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
