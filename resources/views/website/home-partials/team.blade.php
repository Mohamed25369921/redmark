<section class="team-section-two">
    <div class="auto-container">
        <div class="sec-title text-center">
            <span class="sub-title">{{ trans('home.Our team expert') }}</span>
            <h2>{{ trans('home.Meet Professionals') }}</h2>
        </div>
        <div class="carousel-outer">
            <div class="team-carousel-two owl-carousel owl-theme default-dots">
                @foreach ($members as $member)
                    <div class="team-block-two">
                        <div class="inner-box">
                            <div class="info-box">
                                <h5 class="name"><a href="page-team-details.html">{{ $member->name }}</a></h5>
                                <span class="designation">{{ $member->position }}</span>
                                <span class="share-icon fa fa-share-alt"></span>
                                <div class="social-links">
                                    <a href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="image-box">
                                <figure class="image"><a href="javascript:void;"><img
                                            src="{{ url('uploads/testimonials/source/' . $member->img) }}" alt></a></figure>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
