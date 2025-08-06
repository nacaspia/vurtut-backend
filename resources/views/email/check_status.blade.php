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

                <!-- Logo -->
                <tr>
                    <td align="center" style="padding-bottom: 20px;">
                        <a href="https://vurtut.com">
                            <img src="https://vurtut.com/site/images/Vurtut%20logo%20icon/vurtut.com.svg" alt="Vurtut Logo" width="150" style="display: block;">
                        </a>
                    </td>
                </tr>

                <!-- Başlıq -->
                <tr>
                    <td align="center" style="font-size: 22px; font-weight: bold; color: #333333; padding-bottom: 30px;">
                        vurtut.com - {{ !empty($data['full_name']) ? $data['full_name'] : 'Ad Soyad' }}
                    </td>
                </tr>

                <!-- Əlaqə məlumatları -->
                <tr>
                    <td style="padding: 10px 20px; font-size: 16px; color: #333;">
                        <strong>E-poçt:</strong><br>
                        <a href="mailto:{{ $data['email'] ?? 'example@email.com' }}" style="color: #1a73e8; text-decoration: none;">
                            {{ $data['email'] ?? 'example@email.com' }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 10px 20px 20px 20px; font-size: 16px; color: #333;">
                        <strong>Əlaqə nömrəsi:</strong><br>
                        <a href="tel:{{ $data['phone'] ?? '+994000000000' }}" style="color: #1a73e8; text-decoration: none;">
                            {{ $data['phone'] ?? '+994000000000' }}
                        </a>
                    </td>
                </tr>

                <!-- Daxil ol düyməsi -->
                <tr>
                    <td align="center" style="padding: 30px;">
                        <a href="{{ !empty($data['url']) ? $data['url'] : 'https://vurtut.com' }}" style="background-color: #1a73e8; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                            Daxil ol
                        </a>
                    </td>
                </tr>

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
