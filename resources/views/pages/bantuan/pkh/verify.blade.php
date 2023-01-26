@extends('layouts.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <form action="{{ isset($id) ? route('pkh.verify', $pkh->id) : route('pkh.store') }}" method="post">
                @csrf
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
                        value="{{ isset($id) ? $pkh->tgl_pengajuan : old('tgl_pengajuan') }}" disabled>
                    @error('tgl_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="data" value="{{ isset($id) ? json_encode($data) : old('data') }}">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Status</th>
                                <th>Foto KTP</th>
                                <th>Foto Penghasilan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                </div>
            </form>
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
        let dataPenduduk = $("input[name='data']").val()
        dataPenduduk = JSON.parse(dataPenduduk)
        // data = dataPenduduk
        dataPenduduk.map((el, index) => {
            data.push({
                ...el,
                check: false
            })
            tbody += `
                    <tr>
                                    <td><input type="checkbox" name="verify" data-nik="${el.nik}"></td>
                                    <td>${el.nik}</td>
                                    <td>${el.nama}</td>
                                    <td>${el.tempat_lahir + ' '+el.tgl_lahir}</td>
                                    <td>${el.jk}</td>
                                    <td>${el.agama}</td>
                                    <td>${el.status_kawin}</td>
                                    <td>
                                        <a href="${el.foto_ktp}"  target="blank">Foto KTP</a>
                                    </td>
                                    <td>
                                        <a href="${el.foto_penghasilan}" target="blank">Foto Penghasilan</a>
                                    </td>
                                </tr>
                    `;
        })

        $("#tbody").html(tbody)

        // chek all
        $("#checkAll").change(function() {
            if ($(this).is(':checked')) {
                $("input[name='verify']").prop('checked', true);
                for (let i = 0; i < data.length; i++) {
                    data[i].check = true;
                }
                $("input[name='data']").val(JSON.stringify(data));
            } else {
                $("input[name='verify']").prop('checked', false);
                for (let i = 0; i < data.length; i++) {
                    data[i].check = false;
                }
                $("input[name='data']").val(JSON.stringify(data));
            }
        });

        $("input[type='checkbox']").change(function() {
            if ($("input[name='verify']:checked").length === $("input[name='verify']").length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        })

        $("input[name='verify']").click(function() {
            let nik = $(this).data('nik')
            let findIndex = data.findIndex((el) => el.nik == nik);
            if ($(this).is(':checked')) {
                data[findIndex].check = true
                $("input[name='data']").val(JSON.stringify(data));
            } else {
                data[findIndex].check = false
                $("input[name='data']").val(JSON.stringify(data));
            }
        })
    </script>
@endpush
