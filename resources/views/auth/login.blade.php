@extends('layouts.auth')
<title>{{trans('home.login')}}</title>
@section('content')

    <!-- Page -->
    <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="row text-center pl-0 pr-0 ml-0 mr-0">
            <div class="col-lg-3 d-block mx-auto">
                <div class="text-center mb-2">
                    <img src="{{url('uploads/settings/source/'.$configration->app_logo)}}" class="header-brand-img" alt="logo">
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <h4 class="text-center">{{trans('home.Signin to Your Account')}}</h4>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group text-left">
                                <label>{{trans('home.email')}}</label>
                                <input class="form-control" placeholder="{{trans('home.email')}}" type="email"  name="email" @error('email') is-invalid @enderror />
                                @error('email')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-left">
                                <label>{{trans('home.password')}}</label>
                                <input class="form-control" placeholder="{{trans('home.password')}}" type="password" name="password" @error('password') is-invalid @enderror />
                                @error('password')
                                <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn ripple btn-main-primary btn-block">{{trans('home.login')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->

@endsection
