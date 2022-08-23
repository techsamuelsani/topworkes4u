<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
    <link rel="stylesheet" href="\css\vendor\tooltipster.css">
    <link rel="stylesheet" href="\css\vendor\owl.carousel.css">
    <link rel="stylesheet" href="\css\style.css">
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
                <img src="\images\logo.png" alt="logo">
            </figure>
        </a>
        <!-- /LOGO -->

        <!-- MOBILE MENU HANDLER -->
        <div class="mobile-menu-handler left primary">
            <img src="\images\pull-icon.png" alt="pull-icon">
        </div>
        <!-- /MOBILE MENU HANDLER -->

        <!-- LOGO MOBILE -->
        <a href="/">
            <figure class="logo-mobile">
                <img src="\images\logo_mobile.png" alt="logo-mobile">
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
            <img src="\images\logo.png" alt="logo">
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
            <a href="\">Home</a>
        </li>
        <!-- /DROPDOWN ITEM -->

        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="\how">How to Shop</a>
        </li>
        <!-- /DROPDOWN ITEM -->


        <!-- DROPDOWN ITEM -->
        <li class="dropdown-item">
            <a href="\services">Services</a>
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
        <form id="register-form4" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" value="{{$token}}" name="vToken" readonly >
            <label for="name" class="rl-label required">Name</label>
            <input id="name" placeholder="Enter your name here..." type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="email_address6" class="rl-label required">Email Address</label>
            <input id="email" placeholder="Enter your email address here..." value="{{$email}}" readonly type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <label for="username6" class="rl-label">Username</label>
            <input id="username" placeholder="Enter your username here..." type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
            @if ($errors->has('username'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <label for="dob" class="rl-label">Date of Birth</label>
            <input id="dob" type="date" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required>
            @if ($errors->has('dob'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
            @endif
            <label for="password6" class="rl-label required">Password</label>
            <input id="password" placeholder="Enter your password here..." type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label for="repeat_password6" class="rl-label required">Repeat Password</label>
            <input id="password-confirm" type="password" class="form-control" placeholder="Repeat your password here..." name="password_confirmation" required>
            <button class="button mid dark">Register <span class="primary">Now!</span></button>
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
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- Footer -->
<script src="\js\footer.js"></script>
</body>
</html>