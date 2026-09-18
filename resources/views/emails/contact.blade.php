<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <h2 style="color: #c92a2a; border-bottom: 2px solid #eee; padding-bottom: 10px;">Pesan Baru dari Form Kontak Website</h2>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <tr>
            <td style="padding: 8px 0; font-weight: bold; width: 160px;">Nama Pengirim:</td>
            <td style="padding: 8px 0;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Email:</td>
            <td style="padding: 8px 0;"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
        </tr>
        @if(!empty($data['phone']))
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">No. Telepon / WA:</td>
            <td style="padding: 8px 0;">{{ $data['phone'] }}</td>
        </tr>
        @endif
        @if(!empty($data['company']))
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Perusahaan:</td>
            <td style="padding: 8px 0;">{{ $data['company'] }}</td>
        </tr>
        @endif
        @if(!empty($data['service']))
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Kategori Layanan:</td>
            <td style="padding: 8px 0;">{{ $data['service'] }}</td>
        </tr>
        @endif
        @if(!empty($data['preferred_date']))
        <tr>
            <td style="padding: 8px 0; font-weight: bold;">Waktu / Target:</td>
            <td style="padding: 8px 0;">{{ $data['preferred_date'] }}</td>
        </tr>
        @endif
    </table>

    <div style="margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #c92a2a;">
        <h4 style="margin-top: 0; margin-bottom: 8px;">Isi Pesan:</h4>
        <p style="white-space: pre-wrap; margin: 0;">{{ $data['message'] }}</p>
    </div>
</body>
</html>
