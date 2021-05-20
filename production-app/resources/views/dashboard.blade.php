<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php header("Access-Control-Allow-Origin: http://localhost");?>
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/vuetify.min.css')}}"/>

</head>
<body>
<div id=dashboardApp>
<full></full>
    <v-btn></v-btn>
</div>
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<script src="{{mix('/js/dashboard/app.js')}}"></script>
</body>
</html>
