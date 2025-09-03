<!DOCTYPE html>
<html>
<head>
    <title>Daftar Users - {{ date('Y-m-d H:i:s') }}</title>
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
        .role-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }
        .role-admin {
            background-color: #ffebee;
            color: #c62828;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR USERS SISTEM KOST</h1>
        <p>Tanggal Export: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    @if($search || $roleFilter)
    <div class="filters">
        <h3>Filter yang Diterapkan:</h3>
        @if($search)
            <p><strong>Pencarian:</strong> "{{ $search }}"</p>
        @endif
        @if($roleFilter && $roleFilter !== 'all')
            <p><strong>Role:</strong> {{ ucfirst($roleFilter) }}</p>
        @elseif($roleFilter === 'all')
            <p><strong>Role:</strong> Semua Role</p>
        @endif
    </div>
    @endif

    @if($users->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 12%;">Nama</th>
                <th style="width: 18%;">Email</th>
                <th style="width: 8%;">Role</th>
                <th style="width: 12%;">NIK</th>
                <th style="width: 22%;">Alamat</th>
                <th style="width: 5%;">L/P</th>
                <th style="width: 8%;">Status KTP</th>
                <th style="width: 7%;">Profile</th>
                <th style="width: 5%;">Tgl Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : '' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>{{ $user->profile->nik ?? '' }}</td>
                <td>{{ $user->profile->address ?? '' }}</td>
                <td style="text-align: center;">
                    @if($user->profile && $user->profile->gender)
                        {{ $user->profile->gender }}
                    @else
                        
                    @endif
                </td>
                <td style="text-align: center;">
                    @if($user->profile && $user->profile->ktp_file)
                        Ada
                    @else
                        Belum
                    @endif
                </td>
                <td style="text-align: center;">
                    @if($user->profile && $user->profile->is_profile_completed)
                        Lengkap
                    @else
                        Belum
                    @endif
                </td>
                <td style="font-size: 8px;">{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ $users->count() }} user(s)</p>
        <p>Dicetak dari Sistem Manajemen Kost - {{ config('app.name', 'Laravel') }}</p>
    </div>
    @else
    <div class="no-data">
        <p>Tidak ada data user yang sesuai dengan filter yang diterapkan.</p>
    </div>
    @endif
</body>
</html>