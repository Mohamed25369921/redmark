@extends('layouts.app')
@section('meta')
    @php echo $metatags @endphp
    @php echo $schema @endphp
@endsection
@section('content')
    <!-- breadcrumb-area -->
    <div id="content" class="site-content">
        <div class="page-header dtable text-center header-transparent pheader-about"
            style="background-image:url('{{ url('uploads/aboutStrucs/source/' . $about->banner) }}');" alt="about-banner">
            <div class="dcell">
                <div class="container">
                    <h1 class="page-title">{{$service->{'name_'.$lang} }} </h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ trans('home.services') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <section class="services-single">
        <div class="container">
            <div class="row">
                <div class="widget-area col-lg-3 col-md-12">
                    <div class="widget widget_nav_menu">
                        <ul class="services-menu">
                            @foreach ($services as $serv)
                                <li @if (Request::segment(3) == $serv->link_en || Request::segment(3) == $serv->link_ar) class="current-menu-item" @endif>
                                    <a
                                        href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('service/' . $serv->link_en) : LaravelLocalization::localizeUrl('service/' . $serv->link_ar) }}">
                                        {{ app()->getLocale() == 'en' ? $serv->name_en : $serv->name_ar }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="services-detail-content">
                        <div class="ot-heading ">
                            <h2 class="main-heading">
                                {{ app()->getLocale() == 'en' ? $service->name_en : $service->name_ar }} </h2>
                        </div>
                        <div class="simple-slide owl-theme owl-carousel">
                            @foreach ($service->images() as $image)
                                <div class="item">
                                    <img src="{{ url('uploads/services/source/' . $image->image) }}" alt="service-image">
                                </div>
                            @endforeach
                        </div>
                        <p>
                            {!! app()->getLocale() == 'en' ? $service->text_en : $service->text_ar !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---contact--->
    @include('website.home-partials.contact_form')
    <!----map---->
    @include('website.home-partials.maps')
@endsection
