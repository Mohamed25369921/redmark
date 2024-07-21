<footer class="main-footer">
    <div class="pattern-2"></div>

    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">

                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">

                        <img src="{{ Helper::uploadedImagesPath('settings', $configration->footer_logo) }}" alt="">
                        <div class="text">{!! $configration->about_app !!}</div>

                    </div>
                </div>

                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget links-widget">
                        <h6 class="widget-title">{{ trans('home.Explore') }}</h6>
                        <ul class="user-links">
                                                                <li><a href="#">Home</a></li>

                            <li><a href="{{ route('about-us') }}">{{ 'home.about' }}</a></li>
                            <li><a href="{{ route('get_blogs') }}">{{ 'home.news' }}</a></li>
                            <li><a href="{{ route('projects') }}">{{ 'home.our_products' }}</a></li>
                            <li><a href="{{ route('contact-us') }}">{{ 'home.contact_us' }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget links-widget">
                        <h6 class="widget-title">{{ trans('home.services') }}</h6>
                        <ul class="user-links">
                            @foreach ($services as $service)
                                <li><a href="{{ route('get_service_details',$service->id) }}">{{ $service->{'name_'.$lang} }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>



                <div class="footer-column col-lg-3 col-sm-6">
                    <div class="footer-widget contacts-widget">
                        <h6 class="widget-title">{{ trans('home.contact') }}</h6>
                        <div class="text">{{ $configration->address1 }}</div>
                        <ul class="contact-info">
                            <li><i class="fa fa-envelope"></i> <a
                                    href="https://html.kodesolution.com/cdn-cgi/l/email-protection#3d535858595558514d7d4d5249544e5853135e5250"><span
                                        class="__cf_email__"
                                        data-cfemail="731d1616171b161f0333101c1e03121d0a5d101c1e">{{ $setting->email }}</span></a><br />
                            </li>
                            <li><i class="fa fa-phone-square"></i> <a href="tel:+2{{ $setting->mobile }}">{{ $setting->mobile }}</a><br /></li>
                        </ul>
                        <ul class="social-icon-two">
                            @if ($setting->facebook)
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if ($setting->twitter)
                                <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($setting->instgram)
                                <li><a href="{{ $setting->instgram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">All Rights Reserved Red Mark, Developed and Designed by
                    <a href="index.html">Mohamed Seif</a></div>
            </div>
        </div>
    </div>
</footer>


{{-- <footer id="site-footer" class="site-footer" style="background-image:url(resources/assets/front/images/bg/bg-home2.jpg)" alt="background">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4 mb-xl-0">
                <div class="widget-footer text-center">
                    <img src="{{ Helper::uploadedImagesPath('settings', $configration->footer_logo) }}"
                        class="footer-logo" alt="footer_logo">
                    <p>{!! $configration->about_app !!}</p>
                    <div class="footer-social list-social">
                        <ul>
                            @if ($setting->facebook)
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if ($setting->twitter)
                                <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($setting->youtube)
                                <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </li>
                            @endif
                            @if ($setting->instgram)
                                <li><a href="{{ $setting->instgram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4 mb-xl-0">
                <div class="widget-footer text-center">
                    <h6> {{ trans('home.contact-us') }}</h6>
                    <ul class="footer-list">
                        <li class="footer-list-item">
                            <span class="list-item-icon"><i class="ot-flaticon-place"></i></span>
                            <span class="list-item-text">{{ $configration->address1 }}</span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-icon"><i class="ot-flaticon-mail"></i></span>
                            <span class="list-item-text">{{ $setting->contact_email }}</span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-icon"><i class="ot-flaticon-phone-call"></i></span>
                            <span class="list-item-text">{{ $setting->mobile }}</span>
                        </li>
                        <li class="footer-list-item">
                            <span class="list-item-icon"><i class="ot-flaticon-phone-call"></i></span>
                            <span class="list-item-text">{{ $setting->telphone }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- #site-footer -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p>{!! $configration->copy_rights_text !!}</p>
            </div>
        </div>
    </div>
</div> --}}