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
                    <h1 class="page-title">{{ trans('home.gallery') }} </h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{{ trans('home.gallery') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <div class="gallery">
        <div class="container">
            <div class="image-gallery">
                <div id="gallery-2" class="gallery gallery-columns-2 s2">
                    <div class="row">
                        @foreach ($images as $img)
                            <div class="col-md-3">
                                <figure class="gallery-item main-image">
                                    <div class="gallery-icon">
                                        <a href="{{ url('uploads/galleryImages/source/' . $img->img) }}"
                                            data-fancybox="gallery-0" alt="img">
                                            <img src="{{ url('uploads/galleryImages/source/' . $img->img) }}"
                                                alt="img">
                                            <span class="overlay"><i class="ot-flaticon-add"></i></span>
                                        </a>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
