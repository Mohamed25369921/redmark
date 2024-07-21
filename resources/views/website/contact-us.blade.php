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
                    <h1 class="page-title">{{ trans('home.contact-us') }} </h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ trans('home.contact-us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!---contact--->
    @include('website.home-partials.contact_form')
    <!----map---->
    @include('website.home-partials.maps')
@endsection
