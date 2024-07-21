@extends('layouts.app')
<title>{{trans('home.register_as_vendor')}}</title>
@section('content')

<section id="sign">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('home.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.register_as_vendor')}}</li>
            </ol>
        </nav>
        <form method="POST" action="{{ url('vendor-board/register') }}">
            @csrf
            <h2 class="center-title main">{{trans('home.register_as_vendor')}}</h2>
            <div class="row">
                <div class="form-group col-md-6 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="email">{{trans('home.f_name')}}</label>
                    <input type="text" name="f_name" id="f_name" class="form-control @error('f_name') is-invalid @enderror" placeholder="{{trans('home.f_name')}}" value="{{old('f_name')}}">
                    @error('f_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="email">{{trans('home.l_name')}}</label>
                    <input type="text" name="l_name" id="l_name" class="form-control @error('l_name') is-invalid @enderror" placeholder="{{trans('home.l_name')}}" value="{{old('l_name')}}">
                    @error('l_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="email">{{trans('home.email')}}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{trans('home.email')}}" value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="password">{{trans('home.password')}}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{trans('home.password')}}">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="email">{{trans('home.confirm_password')}}</label>
                    <input id="password" type="password" class="form-control validate" name="password_confirmation" placeholder="{{trans('home.confirm_password')}}">
                </div>
            </div> 
            <button class="btn ripple main-btn btn-main-primary">{{trans('home.save_and_continue')}}</button>
            
            <div class="mt-3 text-center">
                <p class="mb-0">{{trans('home.Already have an account?')}}' <a href="{{url('login')}}">{{trans('home.Sign In')}}</a></p>
                <p class="mb-0">{{trans('home.Do_you_want_to_be_avendor?')}} <a href="{{url('vendor-board/register')}}">{{trans('home.create_account')}}</a></p>
            </div>
        </form>
    </div>
</section>    
@endsection
