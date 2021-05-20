<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <h1>Registrovali ste se na sajt treningpla.trcizdravo.com</h1>
    <p>Molimo vas da kliknete na link ispod, kako bi verifikovali svoj nalog.</p>
    <a href="<?php echo e(URL::to('zavrsi-registraciju/' . $token)); ?>">
        <?php echo e(URL::to('zavrsi-registraciju/' . $token)); ?>

    </a>
</body>
</html>
