<table>
    <thead>
        <tr>
            <th>
                <span>NO</span>
            </th>
            <th>
                <span>NAMA </span>
            </th>

            <th>
                <span>PLAFOND</span>
            </th>

            <th>
                <span>MARGIN</span>
            </th>
            <th>
                <span>WILAYAH BUMDES</span>
            </th>
            <th>
                <span>TEMPAT</span>
            </th>
            <th>
                <span>TGL LAHIR</span>
            </th>
            <th>
                <span>NIK</span>
            </th>
            <th>
                <span>NO TELPON/HP</span>
            </th>
            <th>
                <span>ALAMAT</span>
            </th>
            <th>
                <span>DESA</span>
            </th>
            <th>
                <span>KEC</span>
            </th>
            <th>
                <span>KOTA</span>
            </th>
            <th>
                <span>KETERANGAN USAHA</span>
            </th>
            <th>
                <span>IBU KANDUNG</span>
            </th>
            <th style="background-color: green">
                <span>PENDAPATAN</span>
            </th>
            <th style="background-color: green">
                <span>PENGELUARAN</span>
            </th>
            <th>
                <span>ANGGSURAN ATTAQWA</span>
            </th>
            <th>
                <span>TOTAL PENGELUARAN</span>
            </th>
            <th>
                <span>SISA DANA IDEAL </span>
            </th>
            <th>
                <span>30%</span>
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach($sumary as $i => $rekening)
       <tr>
            <th>{{ $i + 1 }}</th>
            <th>{{ $rekening->anggota->nama_pemohon ?? '-' }}</th>
            <th>{{ number_format($rekening->batchs->nominal_dana ?? '-') }}</th>
            <th>{{ number_format($rekening->batchs->interest ?? '-') }}</th>
            <th>{{ $rekening->anggota->bumdes ?? '-' }}</th>
            <th>{{ $rekening->anggota->tempat_lahir ?? '-' }}</th>
            <th>{{ $rekening->anggota->tanggal_lahir ?? '-' }}</th>
            <th>{{ "'" . $rekening->anggota->nik ?? '-' }}</th>
            <th>{{ $rekening->anggota->no_hp ?? $rekening->anggota->no_telpon }}</th>
            <th >{{ $rekening->anggota->nama_jalan }}</th>
            <th>{{ $rekening->anggota->villages->name ?? '-' }}</th>
            <th>{{ $rekening->anggota->districts->name ?? '-' }}</th>
            <th>{{ $rekening->anggota->city->name ?? '-' }}</th>
            <th>{{ $rekening->anggota->keterangan_usaha ?? '-' }}</th>
            <th>{{ $rekening->anggota->nama_ibu ?? '-' }}</th>
            <th style="color: green"></th>
            <th style="color: green"></th>
            <th></th>
            <th></th>
            <th></th>   
       </tr>
        @endforeach
    </tbody>
</table>
