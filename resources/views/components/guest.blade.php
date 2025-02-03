<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }} - {{ $title ?? 'Home' }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title -->
    <title>{{ env('APP_NAME') }} - {{ $title ?? 'Home' }}</title>

    <!-- Favicon -->
    <!-- Open Graph untuk Facebook dan WhatsApp -->
    <meta property="og:title" content="Mandalika Putra Bersama - Distributor  Oli Terpercaya di Indonesia">
    <meta property="og:description"
        content="Mandalika Putra Bersama menyediakan oli berkualitas untuk kendaraan Anda di Indonesia. Kunjungi kami untuk produk terbaik!">
    <meta property="og:image" content="{{ asset('logo_.webp') }}">
    <meta property="og:url" content="https://mandalikaputrabersama.com">
    <meta property="og:type" content="website">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mandalika Putra Bersama - Distributor  Oli Terpercaya di Indonesia">
    <meta name="twitter:description"
        content="Mandalika Putra Bersama menyediakan oli berkualitas untuk kendaraan Anda di Indonesia. Kunjungi kami untuk produk terbaik!">
    <meta name="twitter:image" content="{{ asset('logo_.webp') }}">
    <meta name="twitter:site" content="@mandalikaputra">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/style.css">

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('assets') }}/manifest.json">
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
    <div class="login-back-button">
        <a href="/">
            <i class="bi bi-arrow-left-short"></i>
        </a>
    </div>
    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="custom-container">
            <div class="text-center px-4">
                <img loading="lazy"class="login-intro-img" src="{{ asset('logo_.webp') }}" alt="">
            </div>

            <!-- Register Form -->
            {{ $slot }}

        </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/slideToggle.min.js"></script>
    <script src="{{ asset('assets') }}/js/internet-status.js"></script>
    <script src="{{ asset('assets') }}/js/tiny-slider.js"></script>
    <script src="{{ asset('assets') }}/js/venobox.min.js"></script>
    <script src="{{ asset('assets') }}/js/countdown.js"></script>
    <script src="{{ asset('assets') }}/js/rangeslider.min.js"></script>
    <script src="{{ asset('assets') }}/js/vanilla-dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/index.js"></script>
    <script src="{{ asset('assets') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/js/dark-rtl.js"></script>
    <script src="{{ asset('assets') }}/js/active.js"></script>
    <script src="{{ asset('assets') }}/js/pwa.js"></script>
</body>

</html>
