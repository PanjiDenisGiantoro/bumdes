<table>
    <thead>
        <tr>
            <th>
                <span>NO</span>
            </th>
            <th>
                <span>NAMA Lengkap</span>
            </th>

            <th>
                <span>NIK</span>
            </th>

            <th>
                <span>No Anggota</span>
            </th>
            <th>
                <span>Tanggal Register</span>
            </th>
            <th>
                <span>Kategori Keanggotaan</span>
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach($anggotas as $i => $gota)
       <tr>
            <th>{{ $i + 1 }}</th>
            <th>{{ $gota->nama_pemohon ?? ''}}</th>
            <th>{{ $gota->no_mitra ?? ''}}</th>
            <th>{{ "'" . $gota->nik ?? ''}}</th>
            <th>{{ date('d/m/Y', strtotime($gota->created_at)) ?? '' }}</th>
            <th>{{ $gota->status_keanggotaans->status_keanggotaan ?? ''}}</th>
       </tr>
        @endforeach
    </tbody>
</table>
