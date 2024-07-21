@extends('layouts.app')
<title>{{trans('home.login_as_vendor')}}</title>
@section('content')
<section id="sign">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('home.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.login_as_vendor')}}</li>
            </ol>
        </nav>
        
        <form method="POST" action="{{ url('vendor-board/login') }}">
            @csrf
            <h2 class="center-title">{{trans('home.login_as_vendor')}}</h2>
            <div class="row">
                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="email">{{trans('home.email')}}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{trans('home.email')}}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label for="password">{{trans('home.password')}}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{trans('home.password')}}" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group col-md-12 @if(app()->getLocale() == 'en') text-left @else text-right @endif">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>{{ trans('home.remeber me') }}</span>
                    </label>
                </div>
            </div>    
            <button class="btn ripple main-btn btn-main-primary">{{trans('home.login')}}</button>
            <div class="mt-3 text-center">
                <p class="mb-0">{{trans('home.Dont have an account?')}} <a href="{{url('vendor-board/register')}}">{{trans('home.create_account')}}</a></p>
            </div>
        </form>

    </div>
</section>
@endsection
