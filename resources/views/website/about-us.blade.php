@extends('layouts.app')
@section('meta')
    @php echo $metatags @endphp

    @php echo $schema @endphp
@endsection

@section('content')
    <!-- breadcrumb-area -->
    <div id="content" class="site-content">
        <div class="page-header dtable text-center header-transparent pheader-about"
            style="background-image:url('{{ url('uploads/aboutStrucs/source/' . $about->banner) }}');"
            alt="{{ $about->banner }}">
            <div class="dcell">
                <div class="container">
                    <h1 class="page-title">{{ trans('home.about_us') }} </h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ trans('home.about_us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- about-section -->
    @include('website.home-partials.about-us')
    <!-- about-section end -->
    @include('website.home-partials.team')
    @include('website.home-partials.clients')
@endsection
