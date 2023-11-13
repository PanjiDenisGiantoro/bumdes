<table>
    <thead>
        <tr>
            <th>
                <span>NO</span>
            </th>
            <th>
                <span>Tanggal Register</span>
            </th>

            <th>
                <span>No Anggota</span>
            </th>

            <th>
                <span>Nama Lengkap</span>
            </th>
            <th>
                <span>NIK</span>
            </th>
            <th>
                <span>Provinsi</span>
            </th>

            <th>
                <span>Bumdes</span>
            </th>
            <th>
                <span>Nama Warung</span>
            </th>
            <th>
                <span>Status Warung</span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftar_warung as $i => $data)
       <tr>
            {{-- <th>{{ $i + 1 }}</th>
            <th>{{ $data->nama_pemohon ?? ''}}</th>
            <th>{{ $data->no_mitra ?? ''}}</th>
            <th>{{ "'" . $data->nik ?? ''}}</th>
            <th>{{ date('d/m/Y', strtotime($data->created_at)) ?? '' }}</th>
            <th>{{ $data->status_keanggotaans->status_keanggotaan ?? ''}}</th> --}}
            <td>{{ $i + 1 }}</td>
            <td>{{\Carbon\Carbon::parse($data->tanggal)->format('d/m/Y') ?? ''}}</td>
            <td>{{ $data->anggota->no_mitra ?? '' }}</td>
            <td>{{ $data->anggota->nama_pemohon ?? '' }}</td>
            <td>{{ "'" . $data->anggota->nik ?? '' }}</td>
            <td>{{ $data->alamat_sama ? ($data->anggota->province ?? '') : ($data->province->name ?? '') }}</td>
            <td>{{ $data->anggota->bumdes ?? '' }}</td>
            <td>{{ $data->nama_warung ?? ''}}</td>
            <td>{{ $data->status_aktif_text ?? ''}}</td>
       </tr>
        @endforeach
    </tbody>
</table>
