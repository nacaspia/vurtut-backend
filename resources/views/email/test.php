


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Vurtut.com- {{ !empty($data['full_name'])? $data['full_name']: null }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/invoice.css') }}">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="{{ asset('site/images/favicon.ico') }}">
</head>
<body>
<div class="invoice-box">
    <table>
        <tbody>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tbody>
                    <tr>
                        <td class="title">
                            <img src="{{ asset('site/images/logo2.png') }}" style="width:150px; height:auto" alt="">
                        </td>
                        <td>
                            #: {{ !empty($data['id'])? $data['id']: null }}<br>
                            Tarixi: {{ \Illuminate\Support\Carbon::now() }}<br>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>
                #
            </td>
            <td>
                Ad
            </td>
            <td>
                Email
            </td>
            <td>
                Tel
            </td>
        </tr>
        <tr class="item last">
            <td>
                {{ !empty($data['id'])? $data['id']: null }}
            </td>
            <td>
                {{ !empty($data['full_name'])? $data['full_name']: null }}
            </td>
            <td>
                {{ !empty($data['phone'])? $data['phone']: null }}
            </td>
            <td>
                {{ !empty($data['email'])? $data['email']: null }}
            </td>
        </tr>

        </tbody>
    </table>
</div>
<a href="{{ !empty($data['url'])? $data['url']: null }}" class="print-button">Təsdiqlə</a>
</body>
</html>
