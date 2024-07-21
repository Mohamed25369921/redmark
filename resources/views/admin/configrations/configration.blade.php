@extends('layouts.admin')
@section('meta')
<title>{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</title>
@endsection
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->pull('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
    
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.edit_configration')}} {{trans("home.$configrations->lang")}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/configrations/'.$configrations->lang, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="app_name">{{trans('home.app_name')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.app_name')}}" name="app_name" value="{{ $configrations->app_name }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <fieldset class="form-group">
                                        <label for="about_app">{{trans('home.about_app')}}</label>
                                        <textarea class="form-control area1" placeholder="{{trans('home.about_app')}}" name="about_app"> {!! $configrations->about_app !!}</textarea>
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{trans('home.app_logo')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="app_logo">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>{{trans('home.footer_logo')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="footer_logo">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>{{trans('home.about_image')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="about_image">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>{{trans('home.fav_icon')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="fav_icon">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_icon')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    @if($configrations->app_logo)
                                        <label>{{trans('home.logo')}}</label><br>
                                        <img src="{{url('\uploads\settings\resize200')}}\{{$configration->app_logo}}" width="150">
                                    @endif
                                </div>
                                
                                <div class="form-group col-md-3">
                                    @if($configrations->footer_logo)
                                        <label>{{trans('home.footer_logo')}}</label><br>
                                        <img src="{{url('\uploads\settings\resize200')}}\{{$configration->footer_logo}}" width="150">
                                    @endif
                                </div>

                                <div class="form-group col-md-3">
                                    @if($configrations->about_image)
                                        <label>{{trans('home.about_image')}}</label><br>
                                        <img src="{{url('\uploads\settings\resize200')}}\{{$configration->about_image}}" width="150">
                                    @endif
                                </div>
                                
                                <div class="form-group col-md-3">
                                    @if($configrations->fav_icon)
                                        <label>{{trans('home.fav_icon')}}</label><br>
                                        <img src="{{url('\uploads\settings\resize200')}}\{{$configration->fav_icon}}" width="150">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address1">{{trans('home.address1')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.address1')}}" name="address1" value="{{ $configrations->address1 }}">
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-6">
                                    <fieldset class="form-group">
                                        <label for="address2">{{trans('home.address2')}}</label>
                                        <input type="text" class="form-control" placeholder="{{trans('home.address2')}}" name="address2" value="{{ $configrations->address2 }}">
                                    </fieldset>
                                </div> 
                                
                                <div class="form-group col-md-12">
                                    <fieldset class="form-group">
                                        <label for="copy_rights_text">{{trans('home.copy_rights_text')}}</label>
                                        <textarea class="form-control" placeholder="{{trans('home.copy_rights_text')}}" name="copy_rights_text"> {!! $configrations->copy_rights_text !!}</textarea>
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>

                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection