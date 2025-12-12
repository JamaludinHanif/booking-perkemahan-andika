<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .judul { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 10px; }
        .subtitle { text-align: center; margin-bottom: 15px; }
        .content { margin-top: 20px; line-height: 1.6; }
        table { width: 100%; margin-top: 10px; }
        td { padding: 3px 0; }
        .ttd { width: 50%; text-align: center; float: right; margin-top: 40px; }
    </style>
</head>

<body>

<p class="judul">SURAT KETERANGAN DOMISILI</p>
<p class="subtitle">Nomor: {{ $nomor_surat }}</p>

<div class="content">
    <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>

    <table>
        <tr><td width="30%">Nama</td><td>: <strong>{{ $data->nama_lengkap }}</strong></td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>: {{ $data->tempat_lahir }},
            {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->agama }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
    </table>

    <p>
        Benar bahwa nama tersebut di atas adalah penduduk yang berdomisili di wilayah 
        Desa/Kelurahan Cikaso.
    </p>

    <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>
</div>

<div class="ttd">
    <p>Cikaso, {{ now()->translatedFormat('d F Y') }}</p>
    <p><strong>Lurah/Kepala Desa Cikaso</strong></p>
    <br><br><br>
    <p><strong>Dr. Ust. H. Muhammad Galih S.Kom</strong></p>
</div>

</body>
</html>
