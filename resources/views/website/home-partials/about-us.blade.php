<section class="about-section-six pt-5">
    <div class="bg bg-pattern-4"></div>

    <div class="auto-container">
        <div class="row">

            <div class="image-column col-lg-6">
                <div class="inner-column">
                    <div class="image-box">
                        <figure class="image overlay-anim m-0">
                            <img src="{{ Helper::uploadedImagesPath('aboutStrucs', $about->image) }}" alt="Image">
                        </figure>

                        <div class="exp-box bounce-x">
                            <div class="inner">
                                <div class="icon-box"> <i class="icon flaticon-design"></i> <span
                                        class="count">+10</span> </div>
                                <h6 class="title">{{ trans('home.Years of Experience') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-column col-lg-6">
                <div class="inner-box">
                    <div class="sec-title">
                        <span class="sub-title">{{ trans('about_us') }}</span>
                        <h2 class="title">{{ app()->getLocale() == 'en' ? $about->title_en : $about->title_ar }}</h2>
                        <div class="text">{!! app()->getLocale() == 'en' ? $about->text_en : $about->text_ar !!}</div>
                    </div>
                    <div class="about-block">
                        <div class="inner-box">
                            <h6 class="title">10+</h6>
                            <span>{{ trans('home.Years of working Experience') }}
                                <br />{{ trans('home.in this company') }}</span>
                        </div>
                    </div>
                    <div class="btn-box">

                        @if (Request::segment(2) != 'about-us')
                            <div class="ot-button">
                                <a href="{{ LaravelLocalization::localizeUrl('about-us') }}"
                                    class="theme-btn btn-style-two">
                                    <span class="btn-title">{{ trans('home.more') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if (Request::segment(2) == 'about-us')
<section class="features-section-three">
    <div class="bg bg-image" style="background-image: url(images/icons/pattern-5.jpg);"></div>
    <div class="outer-box">
        <div class="sec-title text-center">
            {{-- <span class="sub-title">What we do</span> --}}
            <h2>{{ trans('home.Ready to give a new   business look') }}</h2>
        </div>
        <div class="row">
            @foreach ($aboutStrucs as $aboutStru)
                <div class="col-md-4">
                    <div class="feature-block-four">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ Helper::uploadedImagesPath('aboutStrucs', $aboutStru->image) }}" alt="Image"></figure>
                                {{-- <h4 class="word">G</h4> --}}
                            </div>
                            <div class="content-box">
                                <h4 class="title"><a href="javascript:void;">{{ $aboutStru->title }}</a></h4>
                                <div class="text">{!! $aboutStru->text !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- <section class="about-1" style="background-image:url(resources/assets/front/images/bg/bg-home2.jpg)" alt="background">
    <div class="grid-lines grid-lines-vertical">
        <span class="g-line-vertical line-left color-line-default"></span>
        <span class="g-line-vertical line-center color-line-default"></span>
        <span class="g-line-vertical line-right color-line-default"></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-5 mb-lg-0">
                <div class="about-img-1">
                    <img src="{{ Helper::uploadedImagesPath('aboutStrucs', $about->image) }}" alt="image">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 align-self-center">
                <div class="about-content-1 ml-xl-70">
                    <div class="ot-heading is-dots">

                        <h2 class="main-heading">{{ app()->getLocale() == 'en' ? $about->title_en : $about->title_ar }}
                        </h2>
                    </div>
                    <p>{!! app()->getLocale() == 'en' ? $about->text_en : $about->text_ar !!}</p>
                    @if (Request::segment(2) != 'about-us')
                        <div class="ot-button">
                            <a href="{{ LaravelLocalization::localizeUrl('about-us') }}"
                                class="octf-btn octf-btn-dark">{{ trans('home.more') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!----value-->
@if (Request::segment(2) == 'about-us')
    <section class="our-philosophy">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 theratio-align-center text-center">
                    <div class="ot-heading is-dots">

                        <h2 class="main-heading text-light"></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($aboutStrucs as $aboutStru)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="support-box">
                            <div class="inner-box">
                                <div class="overlay flex-middle">
                                    <div class="inner">
                                        <p>
                                            {!! $aboutStru->text !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="content-box">
                                    <div class="icon-title">
                                        <span class="ot-flaticon-cube"></span>
                                        <h5>{{ $aboutStru->title }}</h5>
                                    </div>
                                    <!--<img src="{{ Helper::uploadedImagesPath('aboutStrucs', $aboutStru->image) }}"-->
                                    <!--    class="attachment-full size-full lazyloaded" alt="aboutStru->image">-->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif --}}
