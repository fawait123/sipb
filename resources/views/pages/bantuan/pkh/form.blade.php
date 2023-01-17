@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            @if (count($pendaftaran) > 0)
                <form action="{{ isset($id) ? route('pkh.update', $pkh->id) : route('pkh.store') }}" method="post">
                    @csrf
                    @if (isset($id))
                        @method('put')
                    @endif
                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                            placeholder="no_surat" value="{{ isset($id) ? $pkh->no_surat : old('no_surat') }}"
                            {{ isset($id) ? 'disabled' : '' }}>
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_pengajuan">Tanggal Pengajuan</label>
                        <input type="date" name="tgl_pengajuan"
                            class="form-control @error('tgl_pengajuan') is-invalid @enderror" placeholder="tgl_pengajuan"
                            value="{{ isset($id) ? $pkh->tgl_pengajuan : old('tgl_pengajuan') }}">
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
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Status</th>
                                    <th>KTP</th>
                                    <th>Penghasilan</th>
                                    <th>KK</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($pendaftaran as $item)
                                    <tr>
                                        <td>{{ $item->penduduk->nik ?? '' }}</td>
                                        <td>{{ $item->penduduk->nama ?? '' }}</td>
                                        <td>{{ $item->penduduk->jk ?? '' }}</td>
                                        <td>{{ $item->penduduk->agama->agama ?? '' }}</td>
                                        <td>{{ $item->penduduk->status_kawin ?? '' }}</td>
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
                                            <span>{{ $item->status == 'Terdaftar' ? 'Lolos' : $item->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit"
                            class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                    </div>
                </form>
            @else
                <h1>Tidak ada pendaftaran yang ditemukan</h1>
            @endif
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true" data-focus="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="form-group">
                            <label class="form-label">Pilih Penduduk</label>
                            <select class="single-select2" name="penduduk">
                                <option value="">pilih</option>
                                @foreach ($penduduk as $item)
                                    <option value="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                        data-tempat_lahir="{{ $item->tempat_lahir }}"
                                        data-tgl_lahir="{{ $item->tgl_lahir }}" data-jk="{{ $item->jk }}"
                                        data-agama="{{ $item->agama->agama }}"
                                        data-status_kawin="{{ $item->status_kawin }}"
                                        data-kewarganegaraan="{{ $item->kewarganegaraan }}">
                                        {{ $item->nik . ' ' . $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customjs')
    <script>
        let data = [];
        $("select[name='penduduk']").on('change', function() {
            let val = $(this).val()
            let nik = $(this).find(':selected').data('nik');
            let id = $(this).find(':selected').data('id');
            let nama = $(this).find(':selected').data('nama');
            let tempat_lahir = $(this).find(':selected').data('tempat_lahir');
            let tgl_lahir = $(this).find(':selected').data('tgl_lahir');
            let jk = $(this).find(':selected').data('jk');
            let agama = $(this).find(':selected').data('agama');
            let status_kawin = $(this).find(':selected').data('status_kawin');
            let kewarganegaraan = $(this).find(':selected').data('kewarganegaraan');

            let check = data.find((el) => el.nik == nik)
            if (check) {
                $("#exampleVerticallycenteredModal").modal('hide')
                setTimeout(() => {
                    alert(nama + ' sudah ada di daftar list')
                }, 1000);
            } else {
                data.push({
                    id,
                    nik,
                    nama,
                    tempat_lahir,
                    tgl_lahir,
                    jk,
                    agama,
                    status_kawin,
                    kewarganegaraan
                })
                let tbody = ''
                data.map((el) => {
                    tbody += `
                    <tr>
                                    <td>${el.nik}</td>
                                    <td>${el.nama}</td>
                                    <td>${el.tempat_lahir + ' '+el.tgl_lahir}</td>
                                    <td>${el.jk}</td>
                                    <td>${el.agama}</td>
                                    <td>${el.status_kawin}</td>
                                    <td>${el.kewarganegaraan}</td>
                                    <td>
                                        <a class="text-danger remove" href="#" data-nik="${el.nik}">hapus<a/a>
                                    </td>
                                </tr>
                    `;
                })

                $("#tbody").html(tbody)
                $("input[name='data']").val(JSON.stringify(data));
                $("#exampleVerticallycenteredModal").modal('hide')
            }
        })

        $(document).on('click', '.remove', function() {
            let nik = $(this).data('nik')
            const indexOfObject = data.findIndex(object => {
                return object.nik == nik;
            });

            data.splice(indexOfObject, 1)

            let parent = $(this).parent().parent()
            $(parent).remove()
            $("input[name='data']").val(JSON.stringify(data));
        })
    </script>
@endpush

@if (isset($id))
    @push('customjs')
        <script>
            let dataPenduduk = $("input[name='data']").val()
            dataPenduduk = JSON.parse(dataPenduduk)
            // data = dataPenduduk
            dataPenduduk.map((el, index) => {
                data.push(el)
                tbody += `
                    <tr>
                                    <td>${el.nik}</td>
                                    <td>${el.nama}</td>
                                    <td>${el.tempat_lahir + ' '+el.tgl_lahir}</td>
                                    <td>${el.jk}</td>
                                    <td>${el.agama}</td>
                                    <td>${el.status_kawin}</td>
                                    <td>${el.kewarganegaraan}</td>
                                    <td>
                                        <a class="text-danger remove" href="#" data-nik="${el.nik}">hapus<a/a>
                                    </td>
                                </tr>
                    `;
            })

            $("#tbody").html(tbody)
        </script>
    @endpush
@endif
