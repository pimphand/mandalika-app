<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{env('APP_NAME')}} - {{$title ?? "Home"}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title -->
    <title>{{env('APP_NAME')}} - {{$title ?? "Home"}}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets')}}/img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="{{asset('assets')}}/img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets')}}/img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets')}}/img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets')}}/img/icons/icon-180x180.png">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/style.css">

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{asset('assets')}}/manifest.json">
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
        <div class="text-center px-4">
            <img class="login-intro-img" src="{{asset('logo_.webp')}}" alt="">
        </div>

        <!-- Register Form -->
        {{$slot}}

    </div>
</div>
<!-- All JavaScript Files -->
<script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/slideToggle.min.js"></script>
<script src="{{asset('assets')}}/js/internet-status.js"></script>
<script src="{{asset('assets')}}/js/tiny-slider.js"></script>
<script src="{{asset('assets')}}/js/venobox.min.js"></script>
<script src="{{asset('assets')}}/js/countdown.js"></script>
<script src="{{asset('assets')}}/js/rangeslider.min.js"></script>
<script src="{{asset('assets')}}/js/vanilla-dataTables.min.js"></script>
<script src="{{asset('assets')}}/js/index.js"></script>
<script src="{{asset('assets')}}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{asset('assets')}}/js/isotope.pkgd.min.js"></script>
<script src="{{asset('assets')}}/js/dark-rtl.js"></script>
<script src="{{asset('assets')}}/js/active.js"></script>
<script src="{{asset('assets')}}/js/pwa.js"></script>
</body>

</html>
