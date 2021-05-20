<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <h1>Registrovali ste se na Trči Zdravo - Trening Plan</h1>
    <p>Molimo vas da kliknete na link ispod, kako bi verifikovali svoj nalog.</p>
    <a href="{{ URL::to('zavrsi-registraciju/' . $token) }}">
        {{ URL::to('zavrsi-registraciju/' . $token) }}
    </a>
</body>
</html>
