<div class="services-section-two pull-up">
    <div class="bg bg-image" style="background-image: url(images/background/bg-service1.jpg)"></div>
    <div class="auto-container">
        <div class="sec-title text-center">
            <span class="sub-title">{{ trans('home.what we’re offering') }}</span>
            <h2>{{ trans('home.our_projects') }}</h2>
        </div>
        @php
            $icons = [
                'icon flaticon-front-end','icon flaticon-online-shopping','icon flaticon-advertising'
            ];
            $i = 0;
        @endphp
        <div class="carousel-outer">
            <div class="service-carousel owl-carousel owl-theme default-dots">
                @foreach ($projects as $project)
                    <div class="service-block-two">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="icon-box">
                                    <i class="{{ $icons[$i] }}"></i>
                                </div>
                                <figure class="image"><a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}"
                                        class="lightbox-image"><img src="{{ Helper::uploadedImagesPath('projects', $project->image) }}"
                                            alt="Image"></a></figure>
                            </div>
                            <div class="content-box">
                                {{-- <span class="sub-title">01 Service</span> --}}
                                <h4 class="title"><a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}">{{ app()->getLocale() == 'en' ? $project->name_en : $project->name_ar }}</a></h4>
                            </div>
                            <div class="button-box">
                                <a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}" class="read-more">{{ trans('home.read_more') }}<i
                                        class="fa fa-angle-right"></i></a>
                            </div>
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
    </div>
</div>



<!-- courses-area -->
{{-- <section class="courses pt-120 pb-120 p-relative fix">
    <div class="animations-01"><img src="{{ url('resources/assets/front/img/bg/an-img-03.png') }}" alt="an-img-03"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-relative">
                <div class="section-title center-align mb-50 wow fadeInDown animated" data-animation="fadeInDown"
                    data-delay=".4s">
                    <h5><i class="fal fa-graduation-cap"></i>{{ trans('home.Our Courses') }}</h5>
                    <h2>
                        {{ trans('home.Graduate Programs') }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row class-active">

            @foreach ($projects as $key => $project)
                <div class="col-lg-4 col-md-6 ">
                    <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                            <a
                                href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}"><img
                                    src="{{ Helper::uploadedImagesPath('projects', $project->image) }}"
                                    alt="{{ $project->alt_img }}"></a>
                        </div>
                        <div class="courses-content">
                            <div class="cat"><i class="fal fa-graduation-cap"></i> Sciences</div>
                            <h3><a
                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}">{{ app()->getLocale() == 'en' ? $project->name_en : $project->name_ar }}</a>
                            </h3>
                            {!! app()->getLocale() == 'en' ? Str::limit($project->text_en, 30) : Str::limit($project->text_ar, 30) !!}
                            <a href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('project/' . $project->link_en) : LaravelLocalization::localizeUrl('project/' . $project->link_ar) }}"
                                class="readmore">{{ trans('home.more') }} <i class="fal fa-long-arrow-right"></i></a>
                        </div>


                    </div>
                </div>
            @endforeach

        </div>


    </div>
</section> --}}
<!-- courses-area -->
