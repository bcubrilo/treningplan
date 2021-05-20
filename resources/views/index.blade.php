<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-96195546-3"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trening plan</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">


    <script>

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-96195546-3');
    </script>
    <meta name="description" content="Ovdje možete pronaći idealan trening plan za vašu narednu trku. Odaberite svoj plan,
        mi ćemo vam svakog dana kada imate trening poslati email sa instrukcijama. Takođe, nudimo vam mogućnost vođenja vašeg trkačkog dnevnika."/>

    <meta name="keywords" content="trening plan maraton polumaraton 10 trcanje sport rekreacija trening program"/>
    <meta name="title" content="Trcanje plan treninga za maraton, polumaraton"/>
    <meta property="og:image" content="{{asset('images/login.jpg')}}">
    <meta name="twitter:image" content="{{asset('images/login.jpg')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" href="{{asset('/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8787290704403325",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
    <!-- Navigation
    ================================================== -->
    <div class="hero-background">
        <div>
            <img class="strips" src="{{asset('images/strips.png')}}">
        </div>
        <div class="container">
            <div class="header-container header">
                <a class="navbar-brand logo" href="#">
                    <h3 class="bold">Trening Plan</h3>
                </a>

                <div class="header-right">
                    @if(Auth::check())
                        <a class="navbar-item" href="{{route('app')}}">Plan</a>
                    @else
                        <a class="navbar-item" href="{{route('login')}}">Login</a>
                        <a class="navbar-item" href="{{route('register')}}">Registracija</a>
                    @endif
                </div>
            </div>
            <!--navigation-->


            <!-- Hero-Section
              ================================================== -->

            <div class="hero row">
                <div class="hero-right col-sm-6 col-sm-6">
                    <h1 class="header-headline bold">Programi treninga za vas,<br/>potpuno besplatno.</h1>
                    <h4 class="header-running-text light">Bilo da ste početnik, ili iskusan trkač, ovdje
                        možete da pronađete trening plan za vašu predstojeću trku. Brigu o vašem treningu prepustite nama, svakog dana kada
                        imate trening poslaćemo vam email sa instrukcijama.
                    </h4>

                </div><!--hero-left-->

                <div class="col-sm-6 col-sm-6 ipad">
                    <img class="ipad-screen img-responsive" src="{{asset('images/login.jpg')}}"/>
                </div>

                <div><img class="mouse" src="{{asset('images/mouse.svg')}}"></div>

            </div><!--hero-->

        </div> <!--hero-container-->

    </div><!--hero-background-->


    <!-- Features
      ================================================== -->

    <div id="features" class="features-section">

        <div class="features-container row">

            <h2 class="features-headline light">PLANOVI</h2>

            <div class="col-sm-4 feature">

                <div class="feature-icon feature-no-display">
                    <h4>42.2</h4>
                </div>
                <h3 class="feature-head-text feature-no-display"> Maraton </h3>
                <p class="feature-subtext light feature-no-display"> </p>
            </div>

            <div class="col-sm-4 feature">
                <div class="feature-icon feature-no-display feature-display-mid">
                    <h4>21.1</h4>
                </div>
                <h3 class="feature-head-text feature-no-display feature-display-mid"> Polumaraton </h3>
                <p class="feature-subtext light feature-no-display feature-display-mid"></p>
            </div>

            <div class="col-sm-4 feature">
                <div class="feature-icon feature-no-display feature-display-last">
                    <h4>10</h4>
                </div>
                <h3 class="feature-head-text feature-no-display feature-display-last"> 10 km </h3>
                <p class="feature-subtext light feature-no-display feature-display-last"> </p>
            </div>
        </div> <!--features-container-->
    </div> <!--features-section-->
    <div class="footer">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div style="width: 100%;overflow: hidden">
                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.treningplan.trcizdravo.com%2F&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId=656651701184819" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>


                    </div>

                </div>
                <div class="col-sm-6 col-md-4">

                    <h4><a href="https://trcizdravo.com" style="color: white;">Trči Zdravo</a></h4>
                </div>
                <!--webscope-->

                <div class="col-sm-2 col-md-2">
                    <div class="social-links">
                        <a href="https://twitter.com/TrciZdravo"><i class="fa fa-twitter  fa-lg" aria-hidden="true" style="color: white"></i> </a>
                        <a href="https://www.facebook.com/trciZdravoStranica">
                            <i class="fa fa-facebook  fa-lg" aria-hidden="true" style="color: white"></i>
                        </a>
                    </div>
                    <!--social-links-->
                </div>
                <!--social-links-parent-->

            </div>
            <!--row-->

        </div>
        <!--container-->
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>
