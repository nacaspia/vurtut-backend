<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>vurtut.com</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; margin: 30px auto; padding: 20px; border-radius: 8px;">
                <!-- Başlıq -->
                <tr>
                    <td align="center" style="font-size: 22px; font-weight: bold; color: #333333; padding-bottom: 30px;">
                        vurtut.com - {{ !empty($data['full_name']) ? $data['full_name'] : 'Ad Soyad' }}
                    </td>
                </tr>
                @if(!empty($data['email']))
                <!-- Əlaqə məlumatları -->
                <tr>
                    <td style="padding: 10px 20px; font-size: 16px; color: #333;">
                        <strong>E-poçt:</strong><br>
                        <a href="mailto:{{ $data['email'] ?? 'example@email.com' }}" style="color: #1a73e8; text-decoration: none;">
                            {{ $data['email'] ?? 'example@email.com' }}
                        </a>
                    </td>
                </tr>
                @endif
                @if(!empty($data['phone']))
                <tr>
                    <td style="padding: 10px 20px 20px 20px; font-size: 16px; color: #333;">
                        <strong>Əlaqə nömrəsi:</strong><br>
                        <a href="tel:{{ $data['phone'] ?? '+994000000000' }}" style="color: #1a73e8; text-decoration: none;">
                            {{ $data['phone'] ?? '+994000000000' }}
                        </a>
                    </td>
                </tr>
                @endif
                @if(!empty($data['password']))
                <tr>
                    <td style="padding: 10px 20px 20px 20px; font-size: 16px; color: #333;">
                        <strong>Şifrə:</strong><br>
                        <a  style="color: #1a73e8; text-decoration: none;">
                            {{ $data['password'] ?? '' }}
                        </a>
                    </td>
                </tr>
                @endif
                <!-- Ödəniş Çeki -->
                @if(!empty($data['payment_amount']))
                    <tr>
                        <td style="padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border: 1px solid #dddddd; border-radius: 6px;">
                                <tr style="background-color: #f2f2f2;">
                                    <td colspan="2" style="padding: 10px; font-weight: bold; text-align: center;">Ödəniş Təsdiqi (Çek)</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-weight: bold;">Ödənişçi:</td>
                                    <td style="padding: 10px;">{{ $data['full_name'] ?? 'Ad Soyad' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-weight: bold;">Məbləğ:</td>
                                    <td style="padding: 10px;">{{ $data['payment_amount'] ?? '0' }} AZN</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-weight: bold;">Ödəniş Tarixi:</td>
                                    <td style="padding: 10px;">{{ $data['payment_date'] ?? now() }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-weight: bold;">Ödəniş Metodu:</td>
                                    <td style="padding: 10px;">{{ $data['payment_method'] ?? 'Card' }}</td>
                                </tr>
                                @if(!empty($data['payment_reference']))
                                    <tr>
                                        <td style="padding: 10px; font-weight: bold;">Referans №:</td>
                                        <td style="padding: 10px;">{{ $data['payment_reference'] }}</td>
                                    </tr>
                                @endif
                                @if(!empty($data['payment_description']))
                                    <tr>
                                        <td style="padding: 10px; font-weight: bold;">Təsvir:</td>
                                        <td style="padding: 10px;">{{ $data['payment_description'] }}</td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                @endif
                @if(!empty($data['url']))
                <!-- Daxil ol düyməsi -->
                <tr>
                    <td align="center" style="padding: 30px;">
                        <a href="{{ !empty($data['url']) ? $data['url'] : 'https://vurtut.com' }}" style="background-color: #1a73e8; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                            @if(!empty($data['dedicated']) && $data['dedicated']='register')
                                Təsdiq et
                            @else
                                Daxil ol
                            @endif
                        </a>
                    </td>
                </tr>
                @endif

                <!-- Footer -->
                <tr>
                    <td align="center" style="font-size: 14px; color: #888888; border-top: 1px solid #dddddd; padding: 20px;">
                        <p style="margin: 5px;"><a href="https://www.vurtut.com" style="color: #1a73e8; text-decoration: none;">www.vurtut.com</a></p>
                        <p style="margin: 5px;"><a href="mailto:info@vurtut.com" style="color: #1a73e8; text-decoration: none;">info@vurtut.com</a></p>
                        <p style="margin: 5px;"><a href="tel:+994552956727" style="color: #1a73e8; text-decoration: none;">+99455 295 67 27</a></p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
