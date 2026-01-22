<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar BSPS {{ $tahun }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 15mm;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
        }

        .header-simple {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #000;
        }

        .header-simple div {
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .header-title {
            font-size: 14pt;
        }

        .header-loc {
            font-size: 12pt;
        }

        .header-year {
            font-size: 12pt;
            margin-top: 5px;
        }

        /* Table Design */
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 20px;
        }

        .table th {
            background: #f0f0f0;
            border: 1px solid #000;
            padding: 8px 5px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            border: 1px solid #000;
            padding: 6px 5px;
            vertical-align: middle;
            font-size: 9pt;
        }

        .text-center {
            text-align: center;
        }

        .font-numeric {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 10pt;
            letter-spacing: 0.5px;
        }

        /* Signature */
        .signature-wrapper {
            margin-top: 40px;
            float: right;
            width: 250px;
            text-align: center;
            font-size: 10pt;
        }

        .sign-name {
            margin-top: 75px;
            font-weight: bold;
            text-decoration: underline;
            font-size: 10pt;
        }
    </style>
</head>

<body>

    <!-- Header Sesuai Gambar -->
    <div class="header-simple">
        <div class="header-title">DAFTAR USULAN BANTUAN STIMULAN PERUMAHAN (BSPS)</div>
        <div class="header-loc">DESA TERJUN GAJAH</div>
        <div class="header-loc">KABUPATEN TANJUNG JABUNG BARAT</div>
        <div class="header-year">TAHUN {{ $tahun }}</div>
    </div>

    <!-- Tabel Data -->
    <table class="table">
        <thead>
            <tr>
                <th width="35">NO</th>
                <th width="120">NO KK</th>
                <th width="120">NIK</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center font-numeric">{{ $item->no_kk }}</td>
                    <td class="text-center font-numeric">{{ $item->nik }}</td>
                    <td style="font-weight: bold; padding-left: 10px;">{{ $item->nama }}</td>
                    <td style="padding-left: 10px;">{{ $item->dusun }} {{ $item->rt ? 'RT.' . $item->rt : '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Data Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer removed as requested -->
</body>

</html>