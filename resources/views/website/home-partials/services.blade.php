@if (count($services) > 0)
<section class="industries-section style-two">
    <div class="auto-container">
        <div class="sec-title text-center light">
            <h2>{{ trans('home.services') }}</h2>
        </div>
        @php
            $icons = [
                'icon flaticon-color-sample','icon flaticon-front-end','icon flaticon-online-shopping',
                'icon flaticon-advertising','icon flaticon-verification','icon flaticon-design'
            ];
            $i = 0;
        @endphp
        <div class="row justify-content-center">
            @foreach ($services as $service)
                <div class="feature-block-two dark col-xl-2 col-lg-3 col-md-4 col-sm-6 wow fadeInUp animated"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="inner-box ">
                        <i class="{{ $icons[$i] }}"></i>
                        <h6 class="title"><a href="{{ route('get_service_details',$service->id) }}">{{ app()->getLocale() == 'en' ? $service->name_en : $service->name_ar }}</a></h6>
                    </div>
                </div>
                @php
                    $i++;
                    if(count($icons) == $i) {
                        $i = 0;
                    }
                @endphp
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- @if (count($services) > 0)
    <section class="our-skill-3 py-5">
        <div class="container-fluid">
            @if (Request::segment(2) != 'services')
                <div class="ot-heading is-dots text-center">

                    <h2 class="main-heading">{{ trans('home.services') }}</h2>
                </div>
            @endif
            <div class="project-slider-4item projects-grid style-2 no-gaps m-0 img-scale owl-theme owl-carousel">
                @foreach ($services as $service)
                    <div class="project-items">
                        <div class="projects-box">
                            <div class="projects-thumbnail">
                                <a
                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('service/' . $service->link_en) : LaravelLocalization::localizeUrl('service/' . $service->link_ar) }}">
                                    <img src="{{ Helper::uploadedImagesPath('services', $service->img) }}"
                                        alt="$service->img">
                                </a>
                                <div class="overlay">
                                    <h5>{{ app()->getLocale() == 'en' ? $service->name_en : $service->name_ar }}</h5>
                                    <i class="ot-flaticon-add"></i>
                                </div>
                            </div>
                            <div class="portfolio-info">
                                <div class="portfolio-info-inner">
                                    <h5><a class="title-link"
                                            href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('service/' . $service->link_en) : LaravelLocalization::localizeUrl('service/' . $service->link_ar) }}">{{ app()->getLocale() == 'en' ? $service->name_en : $service->name_ar }}</a>
                                    </h5>
                                </div>
                                <a class="overlay"
                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('service/' . $service->link_en) : LaravelLocalization::localizeUrl('service/' . $service->link_ar) }}"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (Request::segment(2) != 'services')
                <div class="ot-button text-center">
                    <a href="{{ LaravelLocalization::localizeUrl('services') }}"
                        class="octf-btn octf-btn-dark">{{ trans('home.more') }}</a>
                </div>
            @endif
        </div>
    </section>
@endif --}}