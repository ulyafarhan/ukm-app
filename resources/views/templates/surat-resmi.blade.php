<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Resmi - {{ $nomor_surat }}</title>
    <style>
        @page { margin: 0.75in; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat */
        .kop-surat {
            width: 100%;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
        }
        .kop-surat td {
            vertical-align: middle;
        }
        .kop-surat .logo {
            width: 80px;
            height: auto;
        }
        .kop-surat .text-kop {
            text-align: center;
        }
        .kop-surat h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }
        .kop-surat h2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
        }
        .kop-surat p {
            font-size: 10pt;
            margin: 0;
        }

        /* Tanggal */
        .tanggal-surat {
            text-align: right;
            margin: 20px 0;
        }

        /* Detail Surat */
        .details-table {
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 2px 0;
            vertical-align: top;
        }
        .details-table .label {
            width: 80px;
        }
        .details-table .separator {
            width: 10px;
            text-align: center;
        }

        /* Tujuan */
        .tujuan-surat {
            margin-bottom: 20px;
        }

        /* Isi Surat */
        .content {
            margin-top: 20px;
        }
        .salam-pembuka,
        .salam-penutup {
            font-style: italic;
        }
        .isi-surat {
            text-align: justify;
            text-indent: 40px;
        }

        /* Tanda Tangan */
        .signature-section {
            margin-top: 50px;
            width: 100%;
        }
        .signature {
            float: right;
            width: 280px;
            text-align: center;
        }
        .signature .jabatan {
            margin-bottom: 80px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <table class="kop-surat">
        <tr>
            <td>
                <img src="{{ public_path('images/logo-ptq.svg') }}" alt="Logo" class="logo">
            </td>
            <td class="text-kop">
                <h1>UNIVERSITAS MALIKUSSALEH</h1>
                <h2>UNIT KEGIATAN MAHASISWA (UKM) PENGEMBANGAN TILAWATIL QUR'AN</h2>
                <p>Alamat Sekretariat: Jalan Kampus Unimal, Reuleut, Kab. Aceh Utara</p>
                <p>Email: ukmptq@unimal.ac.id</p>
            </td>
        </tr>
    </table>

    <!-- Tanggal -->
    <div class="tanggal-surat">
        {{ \Carbon\Carbon::parse($tanggal_surat)->locale('id')->isoFormat('D MMMM YYYY') }}
    </div>

    <!-- Detail Surat -->
    <table class="details-table">
        <tr>
            <td class="label">Nomor</td>
            <td class="separator">:</td>
            <td>{{ $nomor_surat }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran</td>
            <td class="separator">:</td>
            <td>{{ $lampiran }}</td>
        </tr>
        <tr>
            <td class="label">Perihal</td>
            <td class="separator">:</td>
            <td><strong>{{ $perihal }}</strong></td>
        </tr>
    </table>

    <!-- Tujuan -->
    <div class="tujuan-surat">
        <p>
            Kepada Yth.<br>
            <strong>{{ $tujuan_surat }}</strong><br>
            di Tempat
        </p>
    </div>

    <!-- Isi Surat -->
    <div class="content">
        <p class="salam-pembuka">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
        <div class="isi-surat">{!! $isi_surat !!}</div>
        <p>Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
        <p class="salam-penutup">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature-section clearfix">
        <div class="signature">
            <p class="jabatan">{{ $jabatan }},</p>
            <strong><u>{{ $penanggung_jawab }}</u></strong>
        </div>
    </div>
</body>
</html>