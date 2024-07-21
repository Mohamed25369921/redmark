{{--@extends('layouts.app')
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
                <h1 class="page-title">{{ trans('home.services') }} </h1>
                <ul id="breadcrumbs" class="breadcrumbs none-style">
                    <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                    <li class="active">{{ trans('home.services') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area-end -->
    <!-- Project Detail -->
    <section class="project-detail">
        <div class="container">
            <!-- Lower Content -->
            <div class="lower-content">
                <div class="row">
                    <div class="text-column col-lg-9 col-md-9 col-sm-12">
                        <h2>{{ app()->getLocale() == 'en' ? $project->name_en : $project->name_ar }}</h2>

                        <div class="upper-box">
                            <div class="single-item-carousel owl-carousel owl-theme">
                                <figure class="image"><img
                                        src="{{ Helper::uploadedImagesPath('projects', $project->image) }}"
                                        alt="{{ $project->alt_img }}"></figure>
                            </div>
                        </div>
                        <div class="inner-column">
                            {{-- <div class="course-meta2 review style2 clearfix mb-30">
                                <ul class="left">
                                    <li>
                                        <div class="author">
                                            <div class="text">
                                                <a href="#">Robto Jone</a>
                                                <p>Teacher</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="categories">
                                        <div class="author">
                                            <div class="text">
                                                <a href="#" class="course-name">Photoshop</a>
                                                <p>Categories</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="right">
                                    <li class="price">
                                        $59.00
                                    </li>
                                </ul>
                            </div> --}}
                      {{---}}      <h3>{{ trans('home.Course Overview') }}</h3>
                            <p>{!! app()->getLocale() == 'en' ? $project->text_en : $project->text_ar !!}</p>
                            <h3>{{ trans('home.Frequently Asked Question') }}</h3>
                            <p>{!! app()->getLocale() == 'en' ? $project->faq_en : $project->faq_ar !!}</p>
                            <div class="faq-wrap pt-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                                @foreach ($faqs as $key => $faq)
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="#heading{{ $key }}">
                                                <h2 class="mb-0">
                                                    <button class="faq-btn" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $key }}"
                                                        aria-expanded="false">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapse{{ $key }}" class="collapse"
                                                data-bs-parent="#collapse">
                                                <div class="card-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <aside class="sidebar-widget info-column">
                            <div class="inner-column3">
                                <h3>{{ trans('home.Course Features') }}</h3>
                                <ul class="project-info clearfix">
                                    <li>
                                        <span class="icon fal fa-home-lg-alt"></span>
                                        <strong>{{ trans('home.training method') }}:</strong>
                                        <span>{{ app()->getLocale() == 'en' ? $project->instructor_en : $project->instructor_ar }}</span>
                                    </li>

                                    <li>
                                        <span class="icon fal fa-book"></span>
                                        <strong>{{ trans('home.Lectures') }}:</strong>
                                        <span>{{ $project->lectures }}</span>
                                    </li>

                                    <li>
                                        <span class="icon fal fa-clock"></span> <strong>{{ trans('home.Duration') }}:
                                        </strong> <span>{{ $project->duration }} {{ trans('home.weeks') }}</span>
                                    </li>
                                    <!--<li>-->
                                    <!--    <span class="icon fal fa-user"></span> <strong>{{ trans('home.Enrolled') }}:-->
                                    <!--    </strong> <span>{{ $project->enrolled }} {{ trans('home.students') }}</span>-->
                                    <!--</li>-->
                                    <li>
                                        <span class="icon fal fa-globe"></span> <strong>{{ trans('home.Language') }}: </strong>
                                        <span>{{ app()->getLocale() == 'en' ? $project->language_en : $project->language_ar }}</span>
                                    </li>
                                    <li>
                                        <div class="slider-btn">
                                            <a href="{{LaravelLocalization::LocalizeUrl('contact-us')}}" class="btn ss-btn smoth-scroll">{{ trans('home.enrollment') }} <i
                                                    class="fal fa-long-arrow-right"></i></a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <form action="{{ LaravelLocalization::localizeUrl('save/contact-us') }}" method="post" class="contact-form mt-30 wow fadeInUp animated"
                                data-animation="fadeInUp" data-delay=".4s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-name mb-20">
                                            <input type="text" id="firstn" name="name" placeholder="{{trans('home.name')}}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-subject mb-20">
                                            <input type="text" id="email" name="email" placeholder="{{trans('home.email')}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-subject mb-20">
                                            <input type="text" id="phone" name="phone" placeholder="{{trans('home.phone')}}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-message mb-30">
                                            <textarea name="message" id="message" cols="30" rows="10" placeholder="{{trans('home.message')}}"></textarea>
                                        </div>
                                        <div class="slider-btn">
                                            <button class="btn ss-btn" data-animation="fadeInRight"
                                                data-delay=".8s"><span>{{ trans('home.Submit Now') }}</span> <i
                                                    class="fal fa-long-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Project Detail -->
@endsection
