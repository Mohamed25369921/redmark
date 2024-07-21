{{--
@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="ar-eg" href="{{ url('service/'.$service->link_ar) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="ar-eg" href="{{ url('project/'.$project->link_ar) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="ar-eg" href="{{ url('page/'.$page->link_ar) }}" />
@elseif(Request::segment(2) == '')

    <link rel="alternate" hreflang="ar-eg" href="{{ url('/') }}" />
@else
    <link rel="alternate" hreflang="ar-eg" href="{{  LaravelLocalization::getLocalizedURL( null, [], true) }}" />
@endif

--}}


{{--
@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('service/'.$service->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('project/'.$project->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('page/'.$page->link_ar, [], true) }}" />
@else
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL( null, [], true) }}" />
@endif

--}}

@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar','service/'.$service->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'project')
<link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar','project/'.$project->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'category')
<link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar','category/'.$category->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'blog')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar','blog/'.$blog->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar','page/'.$page->link_ar, [], true) }}" />
@else
    <link rel="alternate" hreflang="ar-eg" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" />
@endif

@if(Request::segment(2) == 'service')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'service/'.$service->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'project/'.$project->link_en, [], true) }}"/>
@elseif(Request::segment(2) == 'category')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en','category/'.$category->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'blog')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'blog/'.$blog->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', 'page/'.$page->link_en, [], true) }}"/>
@else
    <link rel="alternate" hreflang="en-eg" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"/>
@endif




@if(app()->getLocale() == 'ar')

@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar','service/'.$service->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar','project/'.$project->link_ar, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar','page/'.$page->link_ar, [], true) }}" />
@else
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" />
@endif

@endif


@if(app()->getLocale() == 'en')

@if(Request::segment(2) == 'service')
   <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(),'service/'.$service->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'project')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(),'project/'.$project->link_en, [], true) }}" />
@elseif(Request::segment(2) == 'page')
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(),'page/'.$page->link_en, [], true) }}" />
@else
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), null, [], true) }}" />
@endif

@endif
