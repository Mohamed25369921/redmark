
@if (count($blogs) > 0)
    <section class="news-section news-section-style-two">
        <div class="bg bg-image"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                {{-- <span class="sub-title">from the blog</span> --}}
                <h2>{{ trans('home.news') }}</h2>
            </div>
            <div class="carousel-outer">
                <div class="news-carousel owl-carousel owl-theme default-dots">
                    @foreach ($blogs as $blog)
                    <div class="news-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}"><img
                                            src="{{ url('uploads/blogitems/source/' . $blog->image) }}" alt="{{ $blog->alt }}"></a></figure>
                                {{-- <div class="date"><span>20</span>OCT</div> --}}
                            </div>
                            <div class="content-box">
                                <ul class="post-info">
                                    @if(isset($blog->writer))<li><i class="fa fa-user"></i>{{ $blog->writer->name }}</li>@endif

                                </ul>
                                <h4 class="title"><a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}">{{ app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar }}</a></h4>
                            </div>
                            <div class="bottom-box">
                                <a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}" class="read-more">{{ trans('home.read_more') }} <i
                                        class="fa fa-long-arrow-alt-right"></i></a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif




{{-- 
@if (count($blogs) > 0)
    <section class="latest-news">
        <div class="grid-lines grid-lines-vertical">
            <span class="g-line-vertical line-left color-line-default"></span>
            <span class="g-line-vertical line-center color-line-default"></span>
            <span class="g-line-vertical line-right color-line-default"></span>
        </div>
        <div class="container">
            <div class="row pb-50">
                @if (Request::segment(2) != 'blogs')
                    <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
                        <div class="ot-heading is-dots">
                            <h2 class="main-heading">{{ trans('home.blogs') }}</h2>
                        </div>
                    </div>
                   
                @endif
            </div>
            <div class="row justify-content-center">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="post-box masonry-post post-item">
                            <div class="post-inner">
                                <div class="entry-media post-cat-abs">
                                    <a
                                        href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}"><img
                                            src="{{ url('uploads/blogitems/source/' . $blog->image) }}"
                                            alt="{{ $blog->alt_img }}"></a>
                                    <div class="post-cat">
                                        <div class="posted-in"><a
                                                href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}">{{ app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar }}
                                            </a></div>
                                    </div>
                                </div>
                                <div class="inner-post">
                                    <div class="entry-header">


                                        <h5 class="entry-title">
                                            <a class="title-link"
                                                href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('blog/' . $blog->link_en) : LaravelLocalization::localizeUrl('blog/' . $blog->link_ar) }}">{{ app()->getLocale() == 'en' ? $blog->title_en : $blog->title_ar }}
                                            </a>
                                        </h5>
                                    </div><!-- .entry-header -->

                                    <div class="the-excerpt">
                                        {!! app()->getLocale() == 'en'
                                            ? strip_tags(mb_strimwidth($blog->text_en, 0, 300, '...'))
                                            : strip_tags(mb_strimwidth($blog->text_ar, 0, 300, '...')) !!}..
                                    </div><!-- .entry-content -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                 <div class="col-lg-12 col-md-12">
                    <div class="ot-button text-center">
                        <a href="{{ LaravelLocalization::localizeUrl('blogs') }}"
                            class="octf-btn octf-btn-dark border-hover-dark">{{ trans('home.all-blogs') }}</a>
                    </div>
            </div>
            </div>
            
        </div>
    </section>
@endif 
--}}