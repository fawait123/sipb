@extends('layouts.app')

@section('content')
    @if ($pendaftaran)
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets') }}/images/avatars/avatar-2.png" class="rounded-circle p-1 border"
                        width="90" height="90" alt="...">
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">{{ $pendaftaran->nama }}, {{ $pendaftaran->nik }}</h5>
                        <p class="mb-0">Pendaftaran bantuan anda sudah dikirim, silahkan pantau terus aplikasi anda</p>
                        <span class="badge bg-primary">{{ $pendaftaran->status }}</span>
                        <br>
                        <span>{{ $pendaftaran->jenis_bantuan }}</span>
                        <br>
                        <br>
                        <span class="text-small text-secondary">{{ $pendaftaran->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6>Foto KTP</h6>
                        <img src="{{ $pendaftaran->foto_ktp }}" alt="{{ $pendaftaran->nama }}" class="img-thumbnail">
                    </div>
                    <div class="col-6">
                        <h6>Foto Penghasilan</h6>
                        <img src="{{ $pendaftaran->foto_penghasilan }}" alt="{{ $pendaftaran->nama }}"
                            class="img-thumbnail">
                    </div>
                    <div class="col-12">
                        <h6>Foto Kartu Keluarga</h6>
                        <img src="{{ $pendaftaran->foto_kk }}" alt="{{ $pendaftaran->nama }}" class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card radius-10">
            <div class="card-body">
                <form action="{{ isset($id) ? route('bpnt.update', $bpnt->id) : route('pendaftaran.store') }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($id))
                        @method('put')
                    @endif
                    <div class="row">
                        <div class="col-xl-9 mx-auto">
                            <h6 class="mb-0 text-uppercase">Jenis Bantuan</h6>
                            <hr />
                            <div class="card">
                                <div class="card-body">
                                    <select name="jenis_bantuan" id="jenis_bantuan" class="form-control" required>
                                        <option value="">pilih</option>
                                        @foreach ($jenis as $item)
                                            <option value="{{ $item->nama_bantuan }}">{{ $item->nama_bantuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 mx-auto">
                            <h6 class="mb-0 text-uppercase">Upload Foto KTP</h6>
                            <hr />
                            <div class="card">
                                <div class="card-body">
                                    <input id="fancy-file-upload" type="file" name="foto_ktp"
                                        accept=".jpg, .png, image/jpeg, image/png" multiple
                                        onchange="encodeImageFileAsURL(this,'ktp')" required>
                                    <input type="hidden" name="ktp" id="ktp">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 mx-auto">
                            <h6 class="mb-0 text-uppercase">Upload Foto KK</h6>
                            <hr />
                            <div class="card">
                                <div class="card-body">
                                    <input id="fancy-file-upload" type="file" name="foto_kk"
                                        accept=".jpg, .png, image/jpeg, image/png" multiple
                                        onchange="encodeImageFileAsURL(this,'kk')" required>
                                    <input type="hidden" name="kk" id="kk">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 mx-auto">
                            <h6 class="mb-0 text-uppercase">Upload Foto Penghasilan</h6>
                            <hr />
                            <div class="card">
                                <div class="card-body">
                                    <input id="fancy-file-upload" type="file" name="foto_penghasilan"
                                        accept=".jpg, .png, image/jpeg, image/png" multiple
                                        onchange="encodeImageFileAsURL(this,'penghasilan')" required>
                                    <input type="hidden" name="penghasilan" id="penghasilan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary btn-sm">Daftar Bantuan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@push('customjs')
    <script>
        function encodeImageFileAsURL(element, input) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                // console.log('RESULT', reader.result)
                $(`#${input}`).val(reader.result);
            }
            reader.readAsDataURL(file);
        }
    </script>
@endpush
