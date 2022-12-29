@extends('layouts.app')

@section('content')
    @if ($pendaftaran)
        @if ($pendaftaran->status == 'Sudah Disalurkan')
            @if (count($umur) > 18250 && $penduduk->penghasilan <= 1500000)
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
        @else
            <div class="">
                <div class="">
                    <div class="container py-2">
                        <h2 class="font-weight-light text-center text-muted py-3">Tracking Pengajuan</h2>
                        <!-- timeline item 1 -->
                        <div class="row">
                            <!-- timeline item 1 left dot -->
                            <div class="col-auto text-center flex-column d-none d-sm-flex">
                                <div class="row h-50">
                                    <div class="col">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                </div>
                                <h5 class="m-2">
                                    <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                </h5>
                                <div class="row h-50">
                                    <div class="col border-end">&nbsp;</div>
                                    <div class="col">&nbsp;</div>
                                </div>
                            </div>
                            <!-- timeline item 1 event content -->
                            <div class="col py-2">
                                <div class="card radius-15">
                                    <div class="card-body">
                                        <div class="float-end text-muted">{{ $pendaftaran->created_at->diffForHumans() }}
                                        </div>
                                        <h4 class="card-title text-muted">{{ $pendaftaran->penduduk->nama ?? '' }}</h4>
                                        <p class="card-text">Status pengajuan bantuan kamu sekarang <b
                                                style="text-transform: uppercase">{{ $pendaftaran->status }}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--container-->
                </div>
            </div>
        @endif
    @else
        {{-- check umur dan penghasilan --}}
        @if (count($umur) > 18250 && $penduduk->penghasilan <= 1500000)
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
