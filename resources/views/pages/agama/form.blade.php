@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('agama.update', $agama->id) : route('agama.store') }}" method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror"
                        placeholder="Agama" value="{{ isset($id) ? $agama->agama : old('agama') }}">
                    @error('agama')
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
