<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Yönləndirilir...</title>
</head>
<body onload="document.forms['paymentForm'].submit();">
<p>Zəhmət olmasa gözləyin, bank sisteminə yönləndirilirsiniz...</p>
<form name="paymentForm" method="POST" action="{{ $toBankUrl }}">
    @foreach($bankParams as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>
</body>
</html>
