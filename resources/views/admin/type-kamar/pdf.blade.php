<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tipe Kamar - {{ date('Y-m-d H:i:s') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .filters {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .filters h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            font-size: 10px;
        }
        .price {
            font-weight: bold;
            color: #dc3545;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        .description {
            max-width: 200px;
            word-wrap: break-word;
        }
        .fasilitas-list {
            font-size: 8px;
            line-height: 1.2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR TIPE KAMAR KOST</h1>
        <p>Tanggal Export: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    @if($search)
    <div class="filters">
        <h3>Filter yang Diterapkan:</h3>
        <p><strong>Pencarian:</strong> "{{ $search }}"</p>
    </div>
    @endif

    @if($typeKamars->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 12%;">Nama Tipe</th>
                <th style="width: 25%;">Deskripsi</th>
                <th style="width: 8%;">Ukuran</th>
                <th style="width: 10%;">Type Kasur</th>
                <th style="width: 12%;">Harga</th>
                <th style="width: 14%;">Fasilitas Kost</th>
                <th style="width: 14%;">Fasilitas Kamar</th>
                <th style="width: 6%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($typeKamars as $index => $typeKamar)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td><strong>{{ $typeKamar->nama }}</strong></td>
                <td class="description">{{ $typeKamar->deskripsi }}</td>
                <td style="text-align: center;">{{ $typeKamar->ukuran_kamar }}</td>
                <td>{{ $typeKamar->type_kasur }}</td>
                <td class="price">Rp {{ number_format($typeKamar->harga, 0, ',', '.') }}</td>
                <td>
                    @if($typeKamar->fasilitas_kost && is_array($typeKamar->fasilitas_kost))
                        <div class="fasilitas-list">
                            @foreach($typeKamar->fasilitas_kost as $fasilitas)
                                <div>• {{ $fasilitas }}</div>
                            @endforeach
                        </div>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($typeKamar->fasilitas_kamar && is_array($typeKamar->fasilitas_kamar))
                        <div class="fasilitas-list">
                            @foreach($typeKamar->fasilitas_kamar as $fasilitas)
                                <div>• {{ $fasilitas }}</div>
                            @endforeach
                        </div>
                    @else
                        -
                    @endif
                </td>
                <td style="font-size: 8px; text-align: center;">{{ $typeKamar->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ $typeKamars->count() }} tipe kamar</p>
        <p>
            Harga terendah: Rp {{ number_format($typeKamars->min('harga'), 0, ',', '.') }} |
            Harga tertinggi: Rp {{ number_format($typeKamars->max('harga'), 0, ',', '.') }}
        </p>
        <p>Dicetak dari Sistem Manajemen Kost - {{ config('app.name', 'Laravel') }}</p>
    </div>
    @else
    <div class="no-data">
        <p>Tidak ada data tipe kamar yang sesuai dengan filter yang diterapkan.</p>
    </div>
    @endif
</body>
</html>