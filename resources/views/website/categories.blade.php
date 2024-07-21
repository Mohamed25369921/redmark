@extends('layouts.app')
@section('meta')
    @php echo $metatags @endphp
@endsection
@section('content')

    <!-- breadcrumb-area -->
    <div id="content" class="site-content">
        <div class="page-header dtable text-center header-transparent pheader-about"
            style="background-image:url('{{ url('uploads/aboutStrucs/source/' . $about->banner) }}');"
            alt="{{ $about->banner }}">
            <div class="dcell">
                <div class="container">
                    <h1 class="page-title">{{ trans('home.categories') }} </h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ trans('home.categories') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- projects -->
    
   <section class="our-skill-3 py-5">
        <div class="container-fluid">
            @if (Request::segment(2) != 'categories')
                <div class="ot-heading is-dots text-center">

                    <h2 class="main-heading">{{ trans('home.categories') }}</h2>
                </div>
            @endif
            <div class="project-slider-4item projects-grid style-2 no-gaps m-0 img-scale owl-theme owl-carousel">
                @foreach ($categories as $category)
                    <div class="project-items">
                        <div class="projects-box">
                            <div class="projects-thumbnail">
                                <a
                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('category/' . $category->link_en) : LaravelLocalization::localizeUrl('category/' . $category->link_ar) }}">
                                    <img src="{{ Helper::uploadedImagesPath('categories', $category->image) }}"
                                        alt="{{$category->{'name_'.$lang} }}">
                                </a>
                                <div class="overlay">
                                    <h5>{{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar }}</h5>
                                    <i class="ot-flaticon-add"></i>
                                </div>
                            </div>
                            <div class="portfolio-info">
                                <div class="portfolio-info-inner">
                                    <h5><a class="title-link"
                                            href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('category/' . $category->link_en) : LaravelLocalization::localizeUrl('category/' . $category->link_ar) }}">{{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar }}</a>
                                    </h5>
                                </div>
                                <a class="overlay"
                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('category/' . $category->link_en) : LaravelLocalization::localizeUrl('category/' . $category->link_ar) }}"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
         
        </div>
    </section>
    <!-- maps -->
    @include('website.home-partials.maps')
@endsection
