<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Theme</title>
    <meta name="Nova theme" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

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
                <a class="navbar-item" href="#team">Login</a>
                <a class="navbar-item" href="#pricing">Registracija</a>
            </div>
        </div>
        <!--navigation-->


        <!-- Hero-Section
          ================================================== -->

        <div class="hero row">
            <div class="hero-right col-sm-6 col-sm-6">
                <h1 class="header-headline bold">Programi treninga za vas,<br/>potpuno besplatno.</h1>
                <h4 class="header-running-text light">Bilo da ste početnik, ili iskusan trkač ovdje možete da pronadjete
                    trening plan za vašu predstojeću trku. Brigu o vašem treningu prepustite nama, svakog dana kada
                    imate trening poslaćemo vam email sa instrukcijama. Pored toga, omogućil smo vam i da vodite dnevni</h4>

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

<!-- Logos
  ================================================== -->

<div class="logos-section">
    <img class="logos" src="assets/images/logos.png"/>
</div><!--logos-section-->

<!-- White-Section
  ================================================== -->

<div class="white-section row">

    <div class="imac col-sm-6">
        <img class="imac-screen img-responsive" src="assets/images/imac.png">
    </div>
    <!--imac-->

    <div class="col-sm-6">

        <div class="white-section-text">

            <h2 class="imac-section-header light">SIMPLE AND BEAUTIFUL</h2>

            <div class="imac-section-desc">

            <span>  Use Nova theme for your next web project.
                It is completely customizable so you can change any of the sections to fit your needs.
                Nova Theme is Free for any kind of use, personal and commercial. Have fun and good luck!</span>
            </div>
        </div>
    </div>
</div><!--white-section-text-section--->


<!-- Pricing
  ================================================== -->
<div id="pricing" class="pricing-background">

    <h2 class="pricing-section-header light text-center">CHOOSE YOUR PRICING PLAN</h2>
    <h4 class=" pricing-section-sub text-center light">Pick any of our super affordable pricing plans</h4>

    <div class="pricing-table row">
        <div class="col-sm-4">
            <div class="plan">
                <h3 class="plan-title light">BASIC</h3>
                <h4 class="plan-cost bold">15</h4>
                <h5 class="monthly">per month</h5>
                <ul class="plan-features">
                    <li>Up to 7 Projects</li>
                    <li>2 Additional Developers</li>
                </ul>
                <div class="plan-price-div text-center">
                    <div class="choose-plan-div">
                        <a class="plan-btn light" href="#">
                            Get Started
                        </a>
                    </div>
                </div>
            </div><!--basic-plan--->
        </div><!--col-->

        <div class="col-sm-4">
            <div class="mid-plan">
                <h3 class="plan-title light">AGENCY</h3>
                <h4 class="plan-cost bold">55</h4>
                <h5 class="monthly">per month</h5>
                <ul class="plan-features">
                    <li>Up to 25 Projects</li>
                    <li>2 Additional Developers</li>
                    <li>Unlimited Support</li>
                </ul>
                <div class="plan-price-div text-center">
                    <div class="choose-plan-div">
                        <a class="plan-btn light" href="#">
                            Get Started
                        </a>
                    </div>
                </div>
            </div><!--pro-plan--->
        </div><!--col-->

        <div class="col-sm-4">
            <div class="plan">
                <h3 class="plan-title light">PRO</h3>
                <h4 class="plan-cost bold">75</h4>
                <h5 class="monthly">per month</h5>
                <ul class="plan-features">
                    <li>Up to 25 Projects</li>
                    <li>2 Additional Developers</li>
                    <li>Unlimited Support</li>
                    <li>1.5GB Disk Space</li>
                </ul>
                <div class="plan-price-div text-center">
                    <div class="choose-plan-div">
                        <a class="plan-btn light" href="#">
                            Get Started
                        </a>
                    </div>
                </div>
            </div><!--pro-plan--->
        </div><!--col-->

    </div>  <!--pricing-table-->

</div><!--pricing-background-->

<!-- Team
  ================================================== -->

<div id="team" class="team">
    <h2 class="team-section-header light text-center">THE TEAM</h2>

    <div class="team-container row">


        <div class="col-sm-4 team-member">
            <img src="assets/images/cto.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">CTO</h4>
                <h5 class="bold">Johnny B Good</h5>
                <p class="light">The brains behind the whole operation</p>
                <a href="http://www.twitter.com"><img class="team-social-icon" src="assets/images/team-twitter.svg"></a>
                <a href="http://www.facebook.com"><img class="team-social-icon"
                                                       src="assets/images/team-facebook.svg"></a>
                <a href="https://plus.google.com/"><img class="team-social-icon"
                                                        src="assets/images/team-google.svg"></a>
            </div>
        </div>

        <div class="col-sm-4 team-member">
            <img src="assets/images/ceo.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">CEO</h4>
                <h5 class="bold">Roll Over Beethoven</h5>
                <p class="light">The one that puts it all together </p>
                <a href="http://www.twitter.com"><img class="team-social-icon" src="assets/images/team-twitter.svg"></a>
                <a href="http://www.facebook.com"><img class="team-social-icon"
                                                       src="assets/images/team-facebook.svg"></a>
                <a href="https://plus.google.com/"><img class="team-social-icon"
                                                        src="assets/images/team-google.svg"></a>
            </div>
        </div>

        <div class="col-sm-4 team-member">
            <img src="assets/images/cfo.png">
            <div class="team-member-text">
                <h4 class="team-member-position light">CFO</h4>
                <h5 class="bold">Chuck Berry</h5>
                <p class="light">The guy with his hand on the wallet</p>
                <a href="http://www.twitter.com"><img class="team-social-icon" src="assets/images/team-twitter.svg"></a>
                <a href="http://www.facebook.com"><img class="team-social-icon"
                                                       src="assets/images/team-facebook.svg"></a>
                <a href="https://plus.google.com/"><img class="team-social-icon"
                                                        src="assets/images/team-google.svg"></a>
            </div>

        </div>
        <! -- .row -->

    </div> <!--team-container--->

</div> <!--team-section--->

<!-- Email-Section
  ================================================== -->

<div class="blue-section">
    <h3 class="blue-section-header bold"> Download FREE!</h3>
    <h4 class="blue-section-subtext light">Take it for a ride for any of your projects!</h4>

    <div class="email-form-div">
        <form id="email-form" class="form-group email-form" action="mailchimp.php" method="post">
            <input type="email" class="form-control email-input" name="email" id="newsletter-email-input"
                   placeholder="Enter your email">
            <button type="submit" class="btn submit-btn">Download</button>
            <div id="newsletter-spinner">
                <i class="fa fa-cog fa-spin" style="font-size:24px"></i>
            </div>
        </form>
    </div>
    <!--email-form-div-->

    <div id="newsletter-loading-div"></div>
    <!--email-form-->
</div>
<!--blue-section-->

<!-- Footer
  ================================================== -->

<div class="footer">

    <div class="container">
        <div class="row">

            <div class="col-sm-2"></div>

            <div class="col-sm-8 webscope">
                <span class="webscope-text"> <a href="https://trcizdravo.com" style="color: white;">Trči Zdravo</a> </span>

            </div>
            <!--webscope-->

            <div class="col-sm-2">
                <div class="social-links">
                    <a href="https://twitter.com/webscopeapp"> <img class="social-link"
                                                                    src="{{asset('images/twitter.svg')}}"/> </a>
                    <a href="https://www.facebook.com/webscopeapp/?ref=aymt_homepage_panel"> <img
                                src="{{asset('images/facebook.svg')}}"/> </a>
                </div>
                <!--social-links-->
            </div>
            <!--social-links-parent-->

        </div>
        <!--row-->

    </div>
    <!--container-->
</div>
<!--footer-->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="{{asset('js/script.js')}}"></script>

</body>

</html>