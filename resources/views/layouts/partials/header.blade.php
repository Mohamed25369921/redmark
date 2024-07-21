<header class="main-header header-style-two">

    <div class="header-top">
        <div class="inner-container">

            <div class="top-left">

                <ul class="list-style-one">

                    <li><i class="fa fa-map-marker-alt"></i> {{ $setting->address }} </li>
                    <li><i class="fa fa-envelope"></i> <a href="javascript:void;"
                            class="mailto:Info@redmark.com">{{ $setting->contact_email }}</a></li>
                </ul>
            </div>

            <div class="top-right">

                <a href="tel:+2{{ $setting->mobile }}" class="info-btn"> <i class="icon fa fa-phone"></i>
                    <small>{{ trans('home.contact_us') }}</small> <strong>{{ $setting->mobile }}</strong> </a>

                <ul class="social-icon-one">
                    @if ($setting->facebook)
                        <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                    @endif
                    @if ($setting->twitter)
                        <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                    @endif
                    @if ($setting->linkedin)
                        <li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    @endif
                    @if ($setting->instgram)
                        <li><a href="{{ $setting->instgram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="header-lower">

        <div class="main-box">
            <div class="logo-box">
                <div class="logo"><a href="{{ LaravelLocalization::localizeUrl('/') }}">
                        <img src="{{ url('uploads/settings/source/' . $configration->app_logo) }}" alt="Logo"
                            title="Soliur"></a></div>
            </div>

            <div class="nav-outer">
                <nav class="nav main-menu">
                    <ul class="navigation">
                        @foreach ($menus as $menu)
                            @if ($menu->type == 'home')
                                <li @if (Request::segment(2) == null) class="current" @endif><a
                                        href="{{ LaravelLocalization::localizeUrl('/') }}">{{ app()->getlocale() == 'en' ? $menu->name_en : $menu->name_ar }}</a>
                                </li>
                            @elseif($menu->type == 'link')
                                <li class="current">
                                    <a href="{{ $menu->type_value }}">{{ app()->getLocale() == 'en' ? $menu->name_en : $menu->name_ar }}
                                    </a>
                                </li>
                            @elseif($menu->type == 'services')
                                <li class="menu-item-has-children @if (Request::segment(2) == 'services') current @endif">
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('services') }}">{{ trans('home.services') }}</a>

                                    <ul class="sub-menu">
                                        @foreach ($menuServices as $menuService)
                                            <li><a
                                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('service/' . $menuService->link_en) : LaravelLocalization::localizeUrl('service/' . $menuService->link_ar) }}">
                                                    {{ app()->getLocale() == 'en' ? $menuService->name_en : $menuService->name_ar }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </li>
                            @elseif($menu->type == 'categories')
                                <li class="menu-item-has-children @if (Request::segment(2) == 'categories') current @endif">
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('categories') }}">{{ trans('home.categories') }}</a>
                                    <ul class="sub-menu">
                                        @foreach ($menuCategories as $menuCategory)
                                            <li>
                                                <a
                                                    href="{{ app()->getLocale() == 'en' ? LaravelLocalization::localizeUrl('category/' . $menuCategory->link_en) : LaravelLocalization::localizeUrl('category/' . $menuCategory->link_ar) }}">
                                                    {{ app()->getLocale() == 'en' ? $menuCategory->name_en : $menuCategory->name_ar }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @elseif(count($menu->subMenu()) > 0)
                                <li class="menu-item-has-children"><a
                                        href="{{ LaravelLocalization::localizeUrl($menu->type) }}">{{ app()->getLocale() == 'en' ? $menu->name_en : $menu->name_ar }}</a>
                                    <ul class="sub-menu">
                                        @foreach ($menu->subMenu() as $subMenu)
                                            <li><a
                                                    href="{{ LaravelLocalization::localizeUrl($subMenu->type) }}">{{ app()->getLocale() == 'en' ? $subMenu->name_en : $subMenu->name_ar }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li @if (Request::segment(2) == $menu->type) class="current" @endif><a
                                        href="{{ LaravelLocalization::localizeUrl("$menu->type") }}">{{ app()->getLocale() == 'en' ? $menu->name_en : $menu->name_ar }}</a>
                                </li>
                            @endif
                        @endforeach
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if ($localeCode == 'ar' && LaravelLocalization::getCurrentLocale() == 'en')
                                <li>
                                    <a hreflang="{{ $localeCode }}"
                                        @if (Request::segment(2) == 'service') href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'service/' . $service->link_ar, [], true) }}"
                                        @elseif(Request::segment(2) == 'product')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'product/' . $product->link_ar, [], true) }}"
                                        @elseif(Request::segment(2) == 'blog')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'blog/' . $blog->link_ar, [], true) }}"
                                        @elseif(Request::segment(2) == 'category')
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'category/' . $category->link_ar, [], true) }}"
                                        @elseif(Request::segment(2) == 'sub-categories')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'sub-categories/' . $category->link_ar . '/' . $category->id) }}"
                                        @elseif(Request::segment(2) == 'page')
                                        
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'page/' . $page->link_ar) }}"
                                

                                        @else
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" @endif>
                                        {{ trans("home.$localeCode") }}
                                    </a>
                                </li>
                            @elseif($localeCode == 'en' && LaravelLocalization::getCurrentLocale() == 'ar')
                                <li>
                                    <a hreflang="{{ $localeCode }}"
                                        @if (Request::segment(2) == 'service') href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'service/' . $service->link_en, [], true) }}"
                                        @elseif(Request::segment(2) == 'product')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'product/' . $product->link_en, [], true) }}"
                                        @elseif(Request::segment(2) == 'blog')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'blog/' . $blog->link_en, [], true) }}"
                                        @elseif(Request::segment(2) == 'category')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'category/' . $category->link_en, [], true) }}"
                                        @elseif(Request::segment(2) == 'sub-categories')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'sub-categories/' . $category->link_en . '/' . $category->id, [], true) }}"
                                            
                                        @elseif(Request::segment(2) == 'page')
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, 'page/' . $page->link_en, [], true) }}"
                                        

                                        @else
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" @endif>
                                        {{ trans("home.$localeCode") }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="outer-box">
                <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
            </div>

            {{-- <div class="btn-box"> <a href="" class="theme-btn btn-style-one hover-light"><span
                        class="btn-title">Arabic</span></a> </div> --}}
        </div>
    </div>

    <div class="mobile-menu">
        <div class="menu-backdrop"></div>

        <nav class="menu-box">
            <div class="upper-box">
                <div class="nav-logo"><a href="{{ LaravelLocalization::localizeUrl('/') }}"><img
                            src="{{ url('uploads/settings/source/' . $configration->app_logo) }}" alt title></a></div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>
            <ul class="navigation clearfix">

            </ul>
            <ul class="contact-list-one">
                <li>

                    <div class="contact-info-box"> <i class="icon lnr-icon-phone-handset"></i> <span
                            class="title">{{ trans('home.contact_us') }}</span> <a
                            href="tel:+2{{ $setting->mobile }}">{{ $setting->mobile }}</a>
                    </div>
                </li>
                <li>

                    <div class="contact-info-box"> <span class="icon lnr-icon-envelope1"></span> <span
                            class="title">Send Email</span> <a
                            href="https://html.kodesolution.com/cdn-cgi/l/email-protection#442c21283404272b2934252a3d6a272b29"><span
                                class="__cf_email__"
                                data-cfemail="c3aba6afb383a0acaeb3a2adbaeda0acae">[email&#160;protected]</span></a>
                    </div>
                </li>


            </ul>
            <ul class="social-links">
                @if ($setting->facebook)
                    <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                @endif
                @if ($setting->twitter)
                    <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    </li>
                @endif
                @if ($setting->instgram)
                    <li><a href="{{ $setting->instgram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="sticky-header sticky-header-style-two">
        <div class="auto-container">
            <div class="inner-container">

                <div class="logo"> <a href="{{ LaravelLocalization::localizeUrl('/') }}" title><img
                            src="{{ url('uploads/settings/source/' . $configration->app_logo) }}" alt title></a> </div>

                <div class="nav-outer">

                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                
                            </ul>
                        </div>
                    </nav>


                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div>

</header>
