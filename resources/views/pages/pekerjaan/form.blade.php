@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('pekerjaan.update', $pekerjaan->id) : route('pekerjaan.store') }}"
                method="post">
                @csrf
                @if (isset($id))
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="pekerjaan">pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
                        placeholder="pekerjaan" value="{{ isset($id) ? $pekerjaan->pekerjaan : old('pekerjaan') }}">
                    @error('pekerjaan')
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
