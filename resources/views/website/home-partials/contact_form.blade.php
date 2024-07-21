<section class="why-choose-us-three pull-up pb-0">
    <div class="bg bg-image" style="background-image: url(images/background/bg-3.jpg)"></div>
    <div class="auto-container">
        <div class="row">

            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="contact-details__right">
                        <div class="sec-title light">
                            <span class="sub-title">{{ trans('home.Need any help?') }}</span>
                            <h2>{{ trans('home.Get in touch with us') }}</h2>
                            <div class="text">{{trans('home.contact us desc')}}</div>
                        </div>
                        <ul class="list-unstyled contact-details__info">
                            <li>
                                <div class="icon">
                                    <span class="lnr-icon-phone-plus"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ trans('home.Have any question?') }}</h6>
                                    <a href="tel:+2{{ $setting->mobile }}"> {{ $setting->mobile }}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="lnr-icon-envelope1"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ trans('home.Write email') }}</h6>
                                    <a
                                        href="https://html.kodesolution.com/cdn-cgi/l/email-protection#a5cbc0c0c1cdc0c9d5e5c6cac8d5c4cbdc8bc6cac8"><span
                                            class="__cf_email__"
                                            data-cfemail="18767d7d7c707d7468587b777568797661367b7775">{{ $setting->email }}</span></a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="lnr-icon-location"></span>
                                </div>
                                <div class="text">
                                    <h6>{{ trans('home.Visit anytime') }}</h6>
                                    <span>{{ $setting->address1 }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="form-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">

                    <div class="contact-form wow fadeInLeft">
                        <h4 class="title">{{ trans('home.Fell Free To Enquire About Any Questions You Got') }}</h4>

                        <form method="post" action="{{ route('saveContactUs') }}"
                            id="contact-form">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="name" placeholder="{{ trans('home.Your Name') }}" required />
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="email" placeholder="{{ trans('home.Enter Email') }}" required />
                                </div>


                                <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="phone" placeholder="{{ trans('home.Your Phone') }}" required />
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" class="form-control" rows="5"
                                        placeholder="{{ trans('home.Write a Message') }}"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <button class="theme-btn btn-style-one hover-light" type="submit"
                                        name="submit-form">
                                        <span class="btn-title">{{ trans('home.Send a Message') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>





{{-- <section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center mb-5 mb-lg-0">
                <div class="contact-left">
                    <h2></h2>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="ajax-form" name="ajax-form"
                        action="{{ LaravelLocalization::localizeUrl('save/contact-us') }}" method="post" class="wpcf7">
                        @csrf
                        <div class="main-form">
                            <p>
                                <label for="name"> <span class="error" id="err-name">
                                        {{ trans('home.name') }}</span></label>
                                <input type="text" name="name" value="" size="40" class=""
                                    aria-invalid="false" placeholder="{{ trans('home.name') }}*" required>
                            </p>
                            <p>
                                <label for="phone"> <span class="error"
                                        id="err-name">{{ trans('home.phone') }}</span></label>
                                <input type="num" name="phone" value="" size="40" class=""
                                    aria-invalid="false" placeholder="{{ trans('home.phone') }}*" required>
                            </p>
                            <p>
                                <label for="email">
                                    <span class="error" id="err-email">{{ trans('home.email') }}</span>

                                </label>
                                <input type="email" name="email" id="email" value="" size="40"
                                    class="" aria-invalid="false" placeholder="{{ trans('home.email') }}*"
                                    required>
                            </p>
                            <p>
                                <label for="message"></label>
                                <textarea name="message" id="message" cols="40" rows="10" class="" aria-invalid="false"
                                    placeholder=" {{ trans('home.message') }} ..." required></textarea>
                            </p>
                            <p><button type="submit" id="send" class="octf-btn">{{ trans('home.send') }}</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-right" style="background-image:url(resources/assets/front/images/image3-home2.png)" alt="background">
                    <div class="ot-heading">

                        <h2 class="main-heading">{{ trans('home.contact-us') }}</h2>
                    </div>

                    <div class="contact-info">
                        <i class="ot-flaticon-place"></i>
                        <div class="info-text">
                            <h6>{{ trans('home.address') }}</h6>
                            <p>{{ $configration->address1 }}</p>
                        </div>
                    </div>
                    <div class="contact-info">
                        <i class="ot-flaticon-mail"></i>
                        <div class="info-text">
                            <h6>{{ trans('home.email') }}</h6>
                            <p><a href="mailto:{{ $setting->contact_email }}">{{ $setting->contact_email }}</a></p>
                        </div>
                    </div>
                    <div class="contact-info">
                        <i class="ot-flaticon-phone-call"></i>
                        <div class="info-text">
                            <h6>{{ trans('home.phone') }} </h6>
                            <p><a href="tel:+2{{ $setting->mobile }}">{{ $setting->mobile }}</a></p>
                        </div>
                    </div>
                    <div class="contact-info">
                        <i class="ot-flaticon-phone-call"></i>
                        <div class="info-text">
                            <h6>{{ trans('home.phone') }}</h6>
                            <p><a href="tel:+2{{ $setting->telphone }}">{{ $setting->telphone }}</a></p>
                        </div>
                    </div>
                    <div class="list-social">
                        <ul>
                            @if ($setting->twitter)
                                <li><a href="{{ $setting->twitter }}" target="_self"><i class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if ($setting->facebook)
                                <li><a href="{{ $setting->facebook }}" target="_self"><i
                                            class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if ($setting->youtube)
                                <li><a href="{{ $setting->youtube }}" target="_self"><i class="fab fa-youtube"></i></a>
                                </li>
                            @endif
                            @if ($setting->instgram)
                                <li><a href="{{ $setting->instgram }}" target="_self"><i
                                            class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}