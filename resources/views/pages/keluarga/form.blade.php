@extends('layouts.app')

@section('content')
    <form action="{{ isset($id) ? route('keluarga.update', $keluarga->id) : route('keluarga.store') }}" method="post">
        @csrf
        @if (isset($id))
            @method('put')
        @endif
        <div class="row">
            <div class="col-6">
                <div class="card radius-10">
                    <div class="card-body">
                        @if (isset($id))
                            <div class="form-group">
                                <label for="no_kk">NO KK</label>
                                <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror"
                                    placeholder="no_kk" value="{{ isset($id) ? $keluarga->no_kk : old('no_kk') }}">
                                @error('no_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kepala_keluarga">Kepala Keluarga</label>
                                <input type="text" name="kepala_keluarga"
                                    class="form-control @error('kepala_keluarga') is-invalid @enderror"
                                    placeholder="kepala_keluarga"
                                    value="{{ isset($id) ? $keluarga->kepala_keluarga : old('kepala_keluarga') }}">
                                @error('kepala_keluarga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <button style="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <select class="single-select" name="nik">
                                    <option value="">pilih</option>
                                    @foreach ($penduduk as $item)
                                        <option value="{{ $item->nik }}">{{ $item->nik . ' ' . $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('nik')
                                    <span class="text-danger">error</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_kk">NO KK</label>
                                <input type="text" name="no_kk"
                                    class="form-control @error('no_kk') is-invalid @enderror" placeholder="no_kk"
                                    value="{{ isset($id) ? $keluarga->no_kk : old('no_kk') }}" id="no_kk">
                                <div class="cover">
                                    <div class="personsMenu">
                                        <div class="no-results"></div>
                                        @foreach ($keluarga as $item)
                                            <div class="item">
                                                <p class="name12">{{ $item->no_kk }}</p>
                                                <p class="email">{{ $item->kepala_keluarga }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @error('no_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kepala_keluarga">Kepala Keluarga</label>
                                <input type="text" name="kepala_keluarga"
                                    class="form-control @error('kepala_keluarga') is-invalid @enderror"
                                    placeholder="kepala_keluarga"
                                    value="{{ isset($id) ? $keluarga->kepala_keluarga : old('kepala_keluarga') }}">
                                @error('kepala_keluarga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="tempat_lahir" value="" disabled>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control @error('jk') is-invalid @enderror"
                                    disabled>
                                    <option value="">pilih</option>
                                    <option value="laki-laki"
                                        {{ (isset($id) && $keluarga->jk == 'laki-laki' ? 'selected' : old('jk') == 'laki-laki') ? 'selected' : '' }}>
                                        Laki Laki</option>
                                    <option value="perempuan"
                                        {{ (isset($id) && $keluarga->jk == 'perempuan' ? 'selected' : old('jk') == 'perempuan') ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select name="agama" id="agama"
                                    class="form-control @error('agama') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    @foreach ($agama as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($id) && $keluarga->id_agama == $item->id ? 'selected' : old('agama') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->agama }}</option>
                                    @endforeach
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status_kawin">Status Kawin</label>
                                <select name="status_kawin" id="status_kawin"
                                    class="form-control @error('status_kawin') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    <option value="kawin"
                                        {{ (isset($id) && $keluarga->status_kawin == 'kawin' ? 'selected' : old('status_kawin') == 'kawin') ? 'selected' : '' }}>
                                        Kawin</option>
                                    <option value="belum kawin"
                                        {{ (isset($id) && $keluarga->status_kawin == 'belum kawin' ? 'selected' : old('status_kawin') == 'belum kawin') ? 'selected' : '' }}>
                                        Belum Kawin</option>
                                </select>
                                @error('status_kawin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <select name="pekerjaan" id="pekerjaan"
                                    class="form-control @error('pekerjaan') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    @foreach ($pekerjaan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($id) && $keluarga->id_pekerjaan == $item->id ? 'selected' : old('pekerjaan') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->pekerjaan }}</option>
                                    @endforeach
                                </select>
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                <select name="kewarganegaraan" id="kewarganegaraan"
                                    class="form-control @error('kewarganegaraan') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    <option value="WNI"
                                        {{ (isset($id) && $keluarga->kewarganegaraan == 'WNI' ? 'selected' : old('kewarganegaraan') == 'WNI') ? 'selected' : '' }}>
                                        WNI</option>
                                    <option value="WNA"
                                        {{ (isset($id) && $keluarga->kewarganegaraan == 'WNA' ? 'selected' : old('kewarganegaraan') == 'WNA') ? 'selected' : '' }}>
                                        WNA</option>
                                </select>
                                @error('kewarganegaraan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="goldar">Golongan Darah</label>
                                <select name="goldar" id="goldar"
                                    class="form-control @error('goldar') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    <option value="A"
                                        {{ (isset($id) && $keluarga->goldar == 'A' ? 'selected' : old('goldar') == 'A') ? 'selected' : '' }}>
                                        A</option>
                                    <option value="AB"
                                        {{ (isset($id) && $keluarga->goldar == 'AB' ? 'selected' : old('goldar') == 'AB') ? 'selected' : '' }}>
                                        AB</option>
                                    <option value="O"
                                        {{ (isset($id) && $keluarga->goldar == 'O' ? 'selected' : old('goldar') == 'O') ? 'selected' : '' }}>
                                        O</option>
                                    <option value="Tidak Tahu"
                                        {{ (isset($id) && $keluarga->goldar == 'Tidak Tahu' ? 'selected' : old('goldar') == 'Tidak Tahu') ? 'selected' : '' }}>
                                        Tidak Tahu</option>
                                </select>
                                @error('goldar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desa">desa</label>
                                <select name="desa" id="desa"
                                    class="form-control @error('desa') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    @foreach ($desa as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($id) && $keluarga->id_desa == $item->id ? 'selected' : old('desa') == $item->id) ? 'selected' : '' }}>
                                            {{ $item->desa }}</option>
                                    @endforeach
                                </select>
                                @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if (!isset($id))
                <div class="col-6">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" placeholder="nama"
                                    value="{{ isset($id) ? $keluarga->nama : old('nama') }}" disabled>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                    cols="10" rows="10" disabled>{{ isset($id) ? $keluarga->alamat : old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror" placeholder="tgl_lahir"
                                    value="{{ isset($id) ? $keluarga->tgl_lahir : old('tgl_lahir') }}" disabled>
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" name="nama_ibu"
                                    class="form-control @error('nama_ibu') is-invalid @enderror" placeholder="nama_ibu"
                                    value="{{ isset($id) ? $keluarga->nama_ibu : old('nama_ibu') }}" disabled>
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" name="nama_ayah"
                                    class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="nama_ayah"
                                    value="{{ isset($id) ? $keluarga->nama_ayah : old('nama_ayah') }}" disabled>
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror" disabled>
                                    <option value="">pilih</option>
                                    <option value="SD"
                                        {{ (isset($id) && $keluarga->pendidikan_terakhir == 'SD' ? 'selected' : old('pendidikan_terakhir') == 'SD') ? 'selected' : '' }}>
                                        SD</option>
                                    <option value="SMP"
                                        {{ (isset($id) && $keluarga->pendidikan_terakhir == 'SMP' ? 'selected' : old('pendidikan_terakhir') == 'SMP') ? 'selected' : '' }}>
                                        SMP</option>
                                    <option value="SMA"
                                        {{ (isset($id) && $keluarga->pendidikan_terakhir == 'SMA' ? 'selected' : old('pendidikan_terakhir') == 'SMA') ? 'selected' : '' }}>
                                        SMA</option>
                                    <option value="Sarjana"
                                        {{ (isset($id) && $keluarga->pendidikan_terakhir == 'Sarjana' ? 'selected' : old('pendidikan_terakhir') == 'Sarjana') ? 'selected' : '' }}>
                                        Sarjana</option>
                                </select>
                                @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit"
                                    class="btn btn-primary btn-sm">{{ isset($id) ? 'Update' : 'Tambah' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection

@push('customjs')
    <script>
        // search for nik
        var $noResults = $('.no-results');
        var $names = $(".name12");
        var $personsMenu = $('.personsMenu');

        var $searchBox = $("#no_kk").on('input', function() {
            var value = $(this).val().trim().toUpperCase();

            if (!value) {
                $personsMenu.hide();
                return;
            }

            var matches = $personsMenu.show().find('div').each(function() {
                var content = $(this).text().toUpperCase();
                $(this).toggle(content.indexOf(value) !== -1);
            });

            $noResults.toggle(matches.filter(':visible').length == 0);
        });

        $('.item').on('click', function() {
            $searchBox.val($(this).find('.name12').text());
            $personsMenu.hide();
            $.ajax({
                url: '{{ route('keluarga.findKeluarga') }}',
                method: 'get',
                data: {
                    no_kk: $(this).find('.name12').text()
                },
                success: function(res) {
                    console.log(res)
                    $("input[name='kepala_keluarga']").val(res.kepala_keluarga)
                }
            })
        });


        $("select[name='nik']").on('change', function() {
            let nik = $(this).val()
            $.ajax({
                url: '{{ route('keluarga.findPenduduk') }}',
                method: 'get',
                data: {
                    nik
                },
                success: function(res) {
                    console.log(res)
                    $("input[name='tempat_lahir']").val(res.tempat_lahir)
                    $("input[name='nama']").val(res.nama)
                    $("#alamat").val(res.alamat)
                    $("select[name='jk']").val(res.jk)
                    $("input[name='tgl_lahir']").val(res.tgl_lahir)
                    $("input[name='nama_ibu']").val(res.nama_ibu)
                    $("input[name='nama_ayah']").val(res.nama_ayah)
                    $("select[name='agama']").val(res.id_agama)
                    $("select[name='status_kawin']").val(res.status_kawin)
                    $("select[name='pekerjaan']").val(res.id_pekerjaan)
                    $("select[name='kewarganegaraan']").val(res.kewarganegaraan)
                    $("select[name='goldar']").val(res.goldar)
                    $("select[name='desa']").val(res.id_desa)
                    $("select[name='pendidikan_terakhir']").val(res.pendidikan_terakhir)
                }
            })
        })
    </script>
@endpush
