@extends('layouts.app') 
@section('meta')
    <title>404</title>
@endsection

@section('content')

    <!--Page Title-->
    <section class="page-title centred jarallax" data-jarallax data-speed="0.2" data-imgPosition="0% 0%" style="background-image: url({{Helper::imageFilesPath('banner/banner-4.webp')}});">
        <div class="container">
            <div class="content-box clearfix">
                <h1>{{trans('home.page not found')}}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{LaravelLocalization::localizeUrl('/')}}">{{trans('home.home')}}</a></li>
                    <li>{{trans('home.page not found')}}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    
    <section id="errors">
         <div class="text-center">
            <img src="{{Helper::imageFilesPath('404.png')}}" height="800px" width="600px"/>
        </div>
        <div class="more-btn centred">
            <a href="{{url('/')}}" class="theme-btn btn-one" >{{trans('home.go_home')}}</a>
            <br>
        </div>
    </section>
@endsection