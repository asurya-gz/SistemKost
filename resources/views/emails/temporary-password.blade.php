<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Sementara - Kost Honest</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .logo {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content {
            padding: 32px 24px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #111827;
        }
        .message {
            margin-bottom: 24px;
            color: #6b7280;
        }
        .password-box {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #fca5a5;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
            text-align: center;
        }
        .password-label {
            font-size: 14px;
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .password-value {
            font-size: 24px;
            font-weight: 700;
            color: #dc2626;
            font-family: 'Monaco', 'Consolas', monospace;
            letter-spacing: 2px;
            background-color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: 1px solid #f87171;
            margin: 8px 0;
        }
        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 16px;
            margin: 24px 0;
        }
        .warning-title {
            font-weight: 600;
            color: #92400e;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .warning-text {
            font-size: 14px;
            color: #b45309;
        }
        .instructions {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            margin: 24px 0;
        }
        .instructions h3 {
            margin: 0 0 16px 0;
            color: #374151;
            font-size: 16px;
            font-weight: 600;
        }
        .instructions ol {
            margin: 0;
            padding-left: 20px;
        }
        .instructions li {
            margin-bottom: 8px;
            color: #6b7280;
        }
        .footer {
            background-color: #f9fafb;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 16px;
        }
        .company-name {
            font-weight: 600;
            color: #dc2626;
        }
        .security-note {
            font-size: 12px;
            color: #6b7280;
            background-color: #f3f4f6;
            padding: 12px;
            border-radius: 6px;
            margin-top: 16px;
        }
        .icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 style="margin: 0; font-size: 24px; font-weight: 700;">Password Sementara</h1>
            <p style="margin: 8px 0 0 0; opacity: 0.9;">Kost Honest Management System</p>
        </div>

        <div class="content">
            <div class="greeting">
                Halo, {{ $user->name }}!
            </div>

            <div class="message">
                Kami telah menerima permintaan untuk mendapatkan password sementara untuk akun Anda. 
                Berikut adalah password sementara yang dapat Anda gunakan untuk masuk ke sistem:
            </div>

            <div class="password-box">
                <div class="password-label">Password Sementara Anda</div>
                <div class="password-value">{{ $temporaryPassword }}</div>
            </div>

            <div class="warning">
                <div class="warning-title">
                    <svg class="icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Penting untuk Diketahui:
                </div>
                <div class="warning-text">
                    Password sementara ini <strong>berlaku selama 1 jam</strong> setelah email ini dikirim dan 
                    <strong>tidak akan mengganggu password asli</strong> Anda. Password asli tetap berfungsi normal.
                </div>
            </div>

            <div class="instructions">
                <h3>Cara Menggunakan Password Sementara:</h3>
                <ol>
                    <li>Kunjungi halaman login Kost Honest</li>
                    <li>Masukkan email Anda: <strong>{{ $user->email }}</strong></li>
                    <li>Masukkan password sementara di atas</li>
                    <li>Klik "Masuk" untuk mengakses akun Anda</li>
                    <li>Password sementara akan otomatis terhapus setelah digunakan</li>
                </ol>
            </div>

            <div class="security-note">
                <strong>Keamanan:</strong> Jika Anda tidak meminta password sementara ini, abaikan email ini. 
                Password asli Anda tetap aman dan tidak berubah. Password sementara akan kedaluwarsa otomatis 
                dalam 1 jam.
            </div>
        </div>

        <div class="footer">
            <div class="footer-text">
                Email ini dikirim otomatis oleh sistem <span class="company-name">Kost Honest</span>
            </div>
            <div class="footer-text">
                Jangan balas email ini. Jika Anda membutuhkan bantuan, silakan hubungi administrator.
            </div>
            <div style="font-size: 12px; color: #9ca3af; margin-top: 16px;">
                © {{ date('Y') }} Kost Honest Management System. Semua hak dilindungi.
            </div>
        </div>
    </div>
</body>
</html>