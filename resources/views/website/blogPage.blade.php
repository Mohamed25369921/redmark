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
                    <h1 class="page-title">{!! app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar !!}</h1>
                    <ul id="breadcrumbs" class="breadcrumbs none-style">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                        <li class="active">{!! app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <!-- property-details -->
    <div class="entry-content">
        <div class="container">
            <div class="row">
                <div class="content-area col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <article class="blog-post post-box">
                        <div class="entry-media post-cat-abs">
                            <img src="{{ Helper::uploadedImagesPath('blogitems', $blog->image) }}" alt="blogimage">
                        </div>
                        <div class="inner-post">
                            <header class="entry-header">
                                <h3 class="entry-title">{!! app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar !!}</h3>
                            </header>
                            <div class="entry-summary the-excerpt">
                                <p>
                                    {!! app()->getLocale() == 'en' ? $blog->text_en : $blog->text_ar !!}
                                </p>
                                <div id="gallery-2" class="gallery galleryid-82 gallery-columns-2 gallery-size-full">
                                    <div class="row">
                                        @foreach ($blog->images() as $image)
                                        <div class="col-md-6">
                                            <figure class="gallery-item">
                                                <div class="gallery-icon landscape">
                                                    <img src="{{ url('uploads/blogitems/source/' . $image->image) }}" alt="grid3">
                                                </div>
                                            </figure>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="widget-area primary-sidebar col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <aside class="widget widget_recent_news">
                        <h6 class="widget-title">{{ trans('home.related_blogs') }}</h6>
                        <ul class="recent-news clearfix">
                            @foreach ($blogs as $key => $blo)
                                <li class="clearfix">
                                    <div class="thumb">
                                        <a
                                            href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blo->link_en) : LaravelLocalization::localizeUrl('blog/' . $blo->link_ar) }}"><img
                                                src="{{ Helper::uploadedImagesPath('blogitems', $blo->image) }}"
                                                alt="relatedblogimag"></a>
                                    </div>
                                    <div class="entry-header">
                                        <h6><a
                                                href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blo->link_en) : LaravelLocalization::localizeUrl('blog/' . $blo->link_ar) }}">{{ app()->getLocale() == 'en' ? $blo->title_en : $blo->title_ar }}</a>
                                        </h6>
                                        <span class="post-on"><span class="entry-date">{!! app()->getLocale() == 'en'
                                            ? strip_tags(mb_strimwidth($blo->text_en, 0, 100, '...'))
                                            : strip_tags(mb_strimwidth($blo->text_ar, 0, 100, '...')) !!}</span></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- property-details end -->

    <!---contact--->
    @include('website.home-partials.contact_form')
    <!----map---->
    @include('website.home-partials.maps')
@endsection
