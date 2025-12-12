<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .judul { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 10px; }
        .subtitle { text-align: center; margin-bottom: 15px; }
        table { width: 100%; margin-top: 10px; }
        td { padding: 3px 0; }
        .content { margin-top: 20px; line-height: 1.6; }
        .ttd { width: 50%; text-align: center; float: right; margin-top: 40px; }
    </style>
</head>

<body>

<p class="judul">SURAT KETERANGAN USAHA</p>
<p class="subtitle">Nomor: {{ $nomor_surat }}</p>

<div class="content">
    <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

    <table>
        <tr><td width="30%">Nama</td><td>: <strong>{{ $data->nama_lengkap }}</strong></td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
    </table>

    <p>
        Benar bahwa yang bersangkutan memiliki usaha dengan jenis:
        <strong>{{ $data->keterangan }}</strong>
    </p>

    <p>
        Usaha tersebut berlokasi di alamat: 
        <strong>{{ $data->alamat }}</strong>
    </p>

    <p>
        Surat ini dibuat sebagai keterangan resmi untuk keperluan:
        <strong>{{ $data->keperluan ?? '-' }}</strong>
    </p>
</div>

<div class="ttd">
    <p>Cikaso, {{ now()->translatedFormat('d F Y') }}</p>
    <p><strong>Lurah/Kepala Desa Cikaso</strong></p>
    <br><br><br>
    <p><strong>Dr. Ust. H. Muhammad Galih S.Kom</strong></p>
</div>

</body>
</html>
