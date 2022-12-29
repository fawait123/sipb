<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Penduduk</th>
            <th>Status Kawin</th>
            <th>Kewarganegaraan</th>
            <th>Jenis Kelamin</th>
            <th>No Surat</th>
            <th>Tanggal Pengajuan</th>
            <th>Tanggal Penerimaan</th>
            <th>Status Pengajuan</th>
            <th>Diverifikasi Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($query as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->penduduk->nik ?? '' }}</td>
                <td>{{ $row->penduduk->nama ?? '' }}</td>
                <td>{{ $row->penduduk->status_kawin ?? '' }}</td>
                <td>{{ $row->penduduk->kewarganegaraan ?? '' }}</td>
                <td>{{ $row->penduduk->jk ?? '' }}</td>
                <td>{{ $row->bantuan->no_surat ?? '' }}</td>
                <td>{{ $row->bantuan->tgl_pengajuan ?? '' }}</td>
                <td>{{ $row->bantuan->tgl_penerimaan ?? '' }}</td>
                <td>{{ $row->status_pengajuan ?? '' }}</td>
                <td>{{ $row->verifikator->nama ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
