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
                    <h1 class="page-title">{{ $lang == 'en' ? $category->name_en : $category->name_ar }}</h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ $lang == 'en' ? $category->name_en : $category->name_ar }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <!-- shop-area -->
    {{--<div class="about-1 py-5">
        <div class="grid-lines grid-lines-vertical">
            <span class="g-line-vertical line-left color-line-default"></span>
            <span class="g-line-vertical line-center color-line-default"></span>
            <span class="g-line-vertical line-right color-line-default"></span>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 align-self-center">
                    <div class="about-content-1 ml-xl-70">
                        <div class="ot-heading is-dots">
                            <h2 class="main-heading">{{ trans('home.about-projects') }} </h2>
                        </div>
                        @foreach ($categories as $Category)
                            @if (Request::segment(3) == $Category->link_en || Request::segment(3) == $Category->link_ar)
                                <p class="py-5">
                                    {{ $lang == 'en' ? $Category->desc_en : $Category->desc_ar }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-12 content-area">
                    <div class="btns">
                        <div class="Call-btn">
                            <a href="tel:+2{{ $setting->mobile }}" class="fixed-phone"
                                target="_blank">{{ trans('home.phone') }}<i class="fa fa-phone"></i> </a>
                        </div>
                        <div class=" Whatsapp-btn">
                            <a href="https://wa.me/+2{{ $setting->whatsapp }}" class="fixed-whatsapp"
                                target="_blank">{{ trans('home.Whatsapp') }}<i class="fab fa-whatsapp"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <div class="gallery">
        <div class="container">
            <div class="image-gallery">
                <div id="gallery-2" class="gallery gallery-columns-2 s2">
                    <div class="row">
                        @foreach ($projects as $key => $project)
                            <div class="col-md-3">
                                <figure class="gallery-item main-image">
                                    <div class="gallery-icon">
                                        <a href="{{ url('uploads/projects/source/' . $project->image) }}"
                                            data-fancybox="gallery-{{ $key }}" alt="imagepro">
                                            <img src="{{ url('uploads/projects/source/' . $project->image) }}"
                                                alt="imageproject">
                                            <span class="overlay"><i class="ot-flaticon-add"></i></span>
                                        </a>
                                    </div>
                                    @foreach ($project->images() as $image)
                                        <div class="d-none">
                                            <a href="{{ url('uploads/projects/source/' . $image->image) }}"
                                                data-fancybox="gallery-{{ $key }}" alt="imagealbum">
                                            </a>
                                        </div>
                                    @endforeach
                                    <div class="entry-header">
                                        <h5 class="entry-title">
                                            {{ app()->getLocale() == 'en' ? $project->name_en : $project->name_ar }} </h5>
                                    </div><!-- .entry-header -->
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area-end -->
@endsection
