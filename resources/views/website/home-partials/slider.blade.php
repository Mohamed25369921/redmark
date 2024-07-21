@if (count($sliders) > 0)
    <section class="main-slider slider-style-one">
        <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_two_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_two" data-version="5.4.1">
                <ul>
                    @foreach ($sliders as $slider)
                        <li data-index="rs-1" data-transition="zoomout">

                            <img src="{{ Helper::uploadedSliderImagesPath('home-sliders', $slider->image) }}" alt class="rev-slidebg">
                            <div class="tp-caption" data-paddingbottom="[15,15,15,15]" data-paddingleft="[15,15,15,15]"
                                data-paddingright="[0,0,0,0]" data-paddingtop="[10,10,10,10]"
                                data-responsive_offset="on" data-type="text" data-height="none"
                                data-width="['750','750','750','750']" data-whitespace="normal"
                                data-hoffset="['0','0','0','0']" data-voffset="['-130','-100','-160','-110']"
                                data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-textalign="['top','top','top','top']"
                                data-frames="[{&quot;delay&quot;:1000,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;auto:auto;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
                                <span class="sub-title">{{ trans('home.The best digital marketing agency') }}</span>
                            </div>
                            <div class="tp-caption" data-paddingbottom="[0,0,0,0]" data-paddingleft="[15,15,15,15]"
                                data-paddingright="[15,15,15,15]" data-paddingtop="[0,0,0,0]"
                                data-responsive_offset="on" data-type="text" data-height="none"
                                data-width="['1050','750','750','480']" data-whitespace="normal"
                                data-hoffset="['0','0','0','0']" data-voffset="['20','30','-20','0']"
                                data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-textalign="['top','top','top','top']"
                                data-frames="[{&quot;delay&quot;:1000,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;auto:auto;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
                                <h1 class="title">{{ trans('home.Grow Your') }} <br /><span>{{ trans('home.business') }}</span></h1>
                            </div>
                            <div class="tp-caption" data-paddingbottom="[0,0,0,0]" data-paddingleft="[15,15,0,5]"
                                data-paddingright="[15,15,15,15]" data-paddingtop="[0,0,0,0]"
                                data-responsive_offset="on" data-type="text" data-height="none"
                                data-width="['700','750','700','450']" data-whitespace="normal"
                                data-hoffset="['0','0','0','0']" data-voffset="['185','180','170','150']"
                                data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-textalign="['top','top','top','top']"
                                data-frames="[{&quot;delay&quot;:1000,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;auto:auto;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
                                <a href="{{ route('about-us') }}" class="theme-btn btn-style-one hover-light"><span
                                        class="btn-title">{{ trans('Discover More') }}</span></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endif

{{-- @if (count($sliders) > 0)
    <section class="main-slider">
                        <h1>{{trans('home.circle')}}</h1>

        <div class="swiper-container thm-swiper__slider"
            data-swiper-options='{
            "slidesPerView": 1,
            "loop": true,
            "effect": "slide",
            "autoplay": {
                "delay": 5000
            },
            "navigation": {
                "nextEl": "#main-slider__swiper-button-next",
                "prevEl": "#main-slider__swiper-button-prev"
            }
        }'>
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="image-layer"
                            style="background-image: url('{{ Helper::uploadedSliderImagesPath('home-sliders', $slider->image) }}');"
                            alt="sliderimages">
                        </div>
                        <!-- /.image-layer -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-7 col-lg-7">

                                
                                    <p>{!! $slider->text !!}</p>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="main-slider__nav">
                <div class="swiper-button-prev" id="main-slider__swiper-button-next"><i
                        class="ot-flaticon-left-arrow"></i>
                </div>
                <div class="swiper-button-next" id="main-slider__swiper-button-prev"><i
                        class="ot-flaticon-right-arrow"></i></div>
            </div>
        </div>
    </section>
    <!-- /.main-slider -->
@endif --}}