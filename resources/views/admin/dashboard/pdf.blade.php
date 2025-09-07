<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Report - {{ $generated_at }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #dc2626;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #dc2626;
            margin: 0;
            font-size: 24px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-card {
            display: table-cell;
            width: 25%;
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            background: #f8f9fa;
        }
        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #dc2626;
        }
        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h3 {
            color: #dc2626;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .monthly-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .monthly-table th, .monthly-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .monthly-table th {
            background-color: #dc2626;
            color: white;
            font-weight: bold;
        }
        .monthly-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .activities-list {
            margin-top: 15px;
        }
        .activity-item {
            padding: 10px;
            border-left: 3px solid #dc2626;
            background: #f8f9fa;
            margin-bottom: 10px;
        }
        .activity-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .activity-desc {
            font-size: 11px;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }
        .summary-row {
            display: table;
            width: 100%;
            margin-top: 20px;
        }
        .summary-col {
            display: table-cell;
            width: 50%;
            padding: 15px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard Report - Sistem Kost</h1>
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="section">
        <h3>Statistik Utama</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_type_kamar'] }}</div>
                <div class="stat-label">Tipe Kamar</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['available_rooms'] }}</div>
                <div class="stat-label">Kamar Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['occupancy_rate'] }}%</div>
                <div class="stat-label">Tingkat Hunian</div>
            </div>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_bookings'] }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['pending_bookings'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['confirmed_bookings'] }}</div>
                <div class="stat-label">Confirmed</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
    </div>

    <!-- Monthly Data and Recent Activities -->
    <div class="summary-row">
        <div class="summary-col">
            <div class="section">
                <h3>Data Bulanan</h3>
                <table class="monthly-table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Bookings</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyData as $data)
                        <tr>
                            <td>{{ $data['month'] }}</td>
                            <td>{{ $data['bookings'] }}</td>
                            <td>Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="summary-col">
            <div class="section">
                <h3>Aktivitas Terbaru</h3>
                <div class="activities-list">
                    @foreach($recentActivities->take(8) as $activity)
                    <div class="activity-item">
                        <div class="activity-title">{{ $activity['title'] }}</div>
                        <div class="activity-desc">{{ $activity['description'] }} - {{ $activity['time'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="section">
        <h3>Statistik Cepat</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['today_users'] }}</div>
                <div class="stat-label">Pendaftar Hari Ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['this_week_bookings'] }}</div>
                <div class="stat-label">Booking Minggu Ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">Rp {{ number_format($stats['this_month_revenue'], 0, ',', '.') }}</div>
                <div class="stat-label">Revenue Bulan Ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['occupied_rooms'] }}</div>
                <div class="stat-label">Kamar Dihuni</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Sistem Kost - Dashboard Report</p>
        <p>Report generated automatically by Sistem Kost Dashboard</p>
    </div>
</body>
</html>