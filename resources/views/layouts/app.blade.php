<!doctype html>
<html class="no-js" lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    @include('layouts.partials.hreflang')
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ Helper::uploadedImagesPath('settings', $configration->fav_icon) }}" />
    <link rel="icon" type="image/x-icon"
        href="{{ Helper::uploadedImagesPath('settings', $configration->fav_icon) }}" />

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ Helper::cssFilesPath('bootstrap.min.css') }}">
    <link href="{{ Helper::pluginFilesPath('revolution/css/settings.css') }}" rel="stylesheet">
    <link href="{{ Helper::pluginFilesPath('revolution/css/layers.css') }}" rel="stylesheet">
    <link href="{{ Helper::pluginFilesPath('revolution/css/navigation.css') }}" rel="stylesheet">


    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <link rel="stylesheet" href="{{ Helper::cssFilesPath('style.css') }}">
    @else
    <link rel="stylesheet" href="{{ Helper::cssFilesPath('style-rtl.css') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@300&display=swap" rel="stylesheet">
    @yield('style')
    <!-- Google Tag Manager -->
    {!! $setting->publish_gtm_script ? html_entity_decode($setting->gtm_script) : '' !!}
    <!-- End Google Tag Manager -->
</head>

<body>
    <div class="page-wrapper">

        <div class="preloader"></div>
        @include('layouts.partials.header')
        @yield('content')

        @include('layouts.partials.footer')
    </div>

    {{-- <a href="https://wa.me/+2{{ $setting->whatsapp }}" target="_blank" class="btn-whatsapp-pulse">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="tel:+2{{ $setting->mobile }}" class="btn-phone-pulse">
        <i class="fa fa-phone"></i>
    </a> --}}

    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ Helper::jsFilesPath('jquery.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('popper.min.js') }}"></script>

    <script src="{{ Helper::pluginFilesPath('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ Helper::pluginFilesPath('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('main-slider-script.js') }}"></script>

    <script src="{{ Helper::jsFilesPath('bootstrap.min.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('jquery.fancybox.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('jquery-ui.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('gsap.min.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('ScrollTrigger.min.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('splitType.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('wow.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('appear.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('swiper.min.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('owl.js') }}"></script>
    <script src="{{ Helper::jsFilesPath('script.js') }}"></script>


    <!-- Google Tag Manager -->
    {!! $setting->publish_gtm_script ? html_entity_decode($setting->gtm_noscript) : '' !!}
    <!-- End Google Tag Manager -->

    @yield('script')
</body>

</html>
