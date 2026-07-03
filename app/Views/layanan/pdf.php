<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Layanan Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }

        body {
            font-size: 12px;
            color: #1e293b;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 15px;
        }

        .header .title {
            font-size: 22px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .header .subtitle {
            font-size: 12px;
            color: #64748b;
        }

        .header .app-name {
            font-size: 13px;
            color: #4f46e5;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 11px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead tr {
            background: #4f46e5;
            color: white;
        }

        thead th {
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
            color: #334155;
        }

        .no-col {
            width: 40px;
            text-align: center;
            color: #94a3b8;
        }

        .harga-col {
            font-weight: bold;
            color: #059669;
        }

        .estimasi-col {
            text-align: center;
        }

        .badge-pill {
            display: inline-block;
            background: #ede9fe;
            color: #4f46e5;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer .info {
            font-size: 10px;
            color: #94a3b8;
        }

        .footer .ttd {
            text-align: center;
            font-size: 11px;
            color: #334155;
        }

        .footer .ttd .ttd-box {
            height: 60px;
            border-bottom: 1px solid #334155;
            width: 150px;
            margin-bottom: 5px;
        }

        .total-row {
            background: #ede9fe !important;
            font-weight: bold;
        }

        .total-row td {
            color: #4f46e5 !important;
            border-top: 2px solid #4f46e5;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="app-name">🧺 LaundryApp - Laundry Management System</div>
    <div class="title">Daftar Layanan Laundry</div>
    <div class="subtitle">Harga dan estimasi pengerjaan laundry</div>
</div>

<table style="font-size:11px; color:#64748b; margin-bottom:15px; width:100%;">
    <tr>
        <td>Tanggal Cetak</td>
        <td>: <?= date('d F Y, H:i') ?> WIB</td>
        <td style="text-align:right;">Total Data: <?= count($layanan) ?> layanan</td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th class="no-col">No</th>
            <th>Nama Layanan</th>
            <th>Harga per Kg</th>
            <th class="estimasi-col">Estimasi Hari</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($layanan as $item): ?>
        <tr>
            <td class="no-col"><?= $no++ ?></td>
            <td><?= esc($item['nama_layanan']) ?></td>
            <td class="harga-col">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
            <td class="estimasi-col">
                <span class="badge-pill"><?= $item['estimasi_hari'] ?> Hari</span>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div style="font-size:10px; color:#94a3b8; text-align:center; margin-top:20px; padding-top:10px; border-top:1px solid #e2e8f0;">
    Dokumen ini dicetak secara otomatis oleh sistem LaundryApp pada <?= date('d M Y H:i') ?> WIB.<br>
    Harga dapat berubah sewaktu-waktu.
</div>

</body>
</html>
