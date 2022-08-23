<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="css\vendor\simple-line-icons.css">
    <link rel="stylesheet" href="css\vendor\tooltipster.css">
    <link rel="stylesheet" href="css\vendor\owl.carousel.css">
    <link rel="stylesheet" href="css\style.css">
    <!-- favicon -->
    <link rel="icon" href="\image\favicon.ico">
    <title>Register| Lancerr.net</title>
    <style>
        .invalid-feedback{
            color: brown;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="header-wrap">
    <header>
        <!-- LOGO -->
        <a href="/">
            <figure class="logo">
                <img src="images\logo.png" alt="logo">
            </figure>
        </a>
        <!-- /LOGO -->

        <!-- MOBILE MENU HANDLER -->
        <div class="mobile-menu-handler left primary">
            <img src="images\pull-icon.png" alt="pull-icon">
        </div>
        <!-- /MOBILE MENU HANDLER -->

        <!-- LOGO MOBILE -->
        <a href="/">
            <figure class="logo-mobile">
                <img src="images\logo_mobile.png" alt="logo-mobile">
            </figure>
        </a>
        <!-- /LOGO MOBILE -->

    </header>
</div>



<!-- SIDE MENU -->
<div id="mobile-menu" class="side-menu left closed">
    <!-- SVG PLUS -->
    <svg class="svg-plus">
        <use xlink:href="#svg-plus"></use>
    </svg>
    <!-- /SVG PLUS -->

    <!-- SIDE MENU HEADER -->
    <div class="side-menu-header">
        <figure class="logo small">
            <img src="images\logo.png" alt="logo">
        </figure>
    </div>
    <!-- /SIDE MENU HEADER -->

    <!-- SIDE MENU TITLE -->
    <p class="side-menu-title">Main Links</p>
    <!-- /SIDE MENU TITLE -->

    <!-- DROPDOWN -->
    <ul class="dropdown dark hover-effect interactive">
        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="index-1.html">Home</a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="how-to-shop.html">How to Shop</a>
        </li>
        <!-- /DROPDOWN ITEM -->


        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="services.html">Services</a>
        </li>
        <!-- /DROPDOWN ITEM -->




    </ul>
    <!-- /DROPDOWN -->
</div>
<!-- /SIDE MENU -->



<br />
<div class="form-popup">
    <!-- FORM POPUP HEADLINE -->
    <div class="form-popup-headline primary">
        <h2>Register Account</h2>
        <p>Register now and start making money from home!</p>
    </div>
    <!-- /FORM POPUP HEADLINE -->

    <!-- FORM POPUP CONTENT -->
    <div class="form-popup-content">
        <form id="register-form4" method="POST" action="/send/link">
          <?php if(isset($_GET['msg'])){ ?>
            <center><h6 style="color: #15e159;" >Registration link sent to email</h6><br>
            <small>Email will reach with in 2 to 20 minutes.</small>
            </center><br>
              <?php } ?>
            @csrf
            <label for="email_address6" class="rl-label required">Email Address</label>
            <input id="email" placeholder="Enter your email address here..." type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
           <button class="button mid dark">Send me registration link <span class="primary">Now!</span></button>
        </form>
        <hr class="line-separator double">
        <!-- /LINE SEPARATOR -->
        <a href="/login" class="button mid secondary">Already have an <span class="primary">Account!</span></a>
    </div>
    <!-- /FORM POPUP CONTENT -->
</div>
<br />

<!-- FOOTER -->
@include('footer')
<!-- /FOOTER -->

<div class="shadow-film closed"></div>



<!-- jQuery -->
<script src="js\vendor\jquery-3.1.0.min.js"></script>
<!-- Tooltipster -->
<script src="js\vendor\jquery.tooltipster.min.js"></script>
<!-- Owl Carousel -->
<script src="js\vendor\owl.carousel.min.js"></script>
<!-- Tweet -->
<script src="js\vendor\twitter\jquery.tweet.min.js"></script>
<!-- xmAlerts -->
<script src="js\vendor\jquery.xmalert.min.js"></script>
<!-- Side Menu -->
<script src="js\side-menu.js"></script>
<!-- Home -->
<script src="js\home.js"></script>
<!-- Tooltip -->
<script src="js\tooltip.js"></script>
<!-- User Quickview Dropdown -->
<script src="js\user-board.js"></script>

<!-- Footer -->
<script src="js\footer.js"></script>
</body>
</html>