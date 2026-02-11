<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengesahan E-mel - Alumni 4B Malaysia</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #242e81; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 24px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 8px 8px; }
        .btn { display: inline-block; background: #242e81; color: white !important; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin: 16px 0; }
        .btn:hover { background: #1e2669; }
        .footer { margin-top: 24px; font-size: 12px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Alumni 4B Malaysia</h1>
        <p style="margin: 8px 0 0 0; opacity: 0.9;">Pengesahan E-mel Akaun Staf</p>
    </div>
    <div class="content">
        <p>Assalamualaikum {{ $user->name }},</p>
        <p>Terima kasih kerana mendaftar akaun staf Alumni 4B Malaysia. Sila klik butang di bawah untuk mengesahkan alamat e-mel anda dan mengaktifkan akaun.</p>
        <p style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="btn">Sahkan E-mel Saya</a>
        </p>
        <p>Atau salin pautan berikut ke penyemak imbas anda:</p>
        <p style="word-break: break-all; font-size: 12px; color: #6b7280;">{{ $verificationUrl }}</p>
        <p>Pautan ini akan tamat tempoh dalam 60 minit.</p>
        <p>Jika anda tidak meminta pendaftaran ini, sila abaikan e-mel ini.</p>
    </div>
    <div class="footer">
        <p>E-mel ini dihantar secara automatik oleh Sistem Alumni 4B Malaysia.</p>
    </div>
</body>
</html>
