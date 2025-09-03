<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kamar Kost - {{ date('Y-m-d H:i:s') }}</title>
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
        .status-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }
        .status-tersedia {
            background-color: #d4edda;
            color: #155724;
        }
        .status-booked {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-dihuni {
            background-color: #f8d7da;
            color: #721c24;
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
        .price {
            font-weight: bold;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR KAMAR KOST SISTEM KOST</h1>
        <p>Tanggal Export: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    @if($search || $statusFilter)
    <div class="filters">
        <h3>Filter yang Diterapkan:</h3>
        @if($search)
            <p><strong>Pencarian:</strong> "{{ $search }}"</p>
        @endif
        @if($statusFilter && $statusFilter !== 'all')
            <p><strong>Status:</strong> {{ ucfirst($statusFilter) }}</p>
        @elseif($statusFilter === 'all')
            <p><strong>Status:</strong> Semua Status</p>
        @endif
    </div>
    @endif

    @if($kamars->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Nama Kamar</th>
                <th style="width: 15%;">Tipe Kamar</th>
                <th style="width: 15%;">Harga</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 25%;">Deskripsi</th>
                <th style="width: 8%;">Fasilitas</th>
                <th style="width: 5%;">Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kamars as $index => $kamar)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $kamar->nama_kamar }}</td>
                <td>{{ $kamar->typeKamar ? $kamar->typeKamar->nama : '-' }}</td>
                <td class="price">
                    @if($kamar->typeKamar)
                        Rp {{ number_format($kamar->typeKamar->harga, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <span class="status-badge 
                        @if($kamar->status_kamar == 'Tersedia') status-tersedia
                        @elseif($kamar->status_kamar == 'Booked') status-booked
                        @else status-dihuni
                        @endif">
                        {{ $kamar->status_kamar }}
                    </span>
                </td>
                <td>{{ $kamar->typeKamar ? Str::limit($kamar->typeKamar->deskripsi, 80) : '-' }}</td>
                <td style="font-size: 8px;">
                    @if($kamar->typeKamar && $kamar->typeKamar->fasilitas)
                        {{ Str::limit($kamar->typeKamar->fasilitas, 50) }}
                    @else
                        -
                    @endif
                </td>
                <td style="font-size: 8px;">{{ $kamar->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ $kamars->count() }} kamar</p>
        <p>Status: Tersedia: {{ $kamars->where('status_kamar', 'Tersedia')->count() }} | Booked: {{ $kamars->where('status_kamar', 'Booked')->count() }} | Dihuni: {{ $kamars->where('status_kamar', 'Dihuni')->count() }}</p>
        <p>Dicetak dari Sistem Manajemen Kost - {{ config('app.name', 'Laravel') }}</p>
    </div>
    @else
    <div class="no-data">
        <p>Tidak ada data kamar yang sesuai dengan filter yang diterapkan.</p>
    </div>
    @endif
</body>
</html>