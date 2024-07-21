@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_about')}}</title>
@endsection
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.about')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/about')}}">{{trans('home.about')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_about')}}</li>
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

    {!! Form::open(['method'=>'PATCH','route' => 'admin.about.update', 'data-toggle'=>'validator', 'files'=>'true']) !!}

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title ">{{trans('home.edit_about')}}</h6>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-3"> 
                                <label for="title_en">{{trans('home.title_en')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" value="{{$about->title_en}}">
                            </div>

                            <div class="form-group col-md-3 ">     
                                <label for="title_ar">{{trans('home.title_ar')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar" value="{{$about->title_ar}}">
                            </div>

                            <div class="form-group col-md-2">
                                <label>{{trans('home.image')}}</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> {{trans('home.upload')}}</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-1"> 
                                <label for="alt_img">{{trans('home.alt_img')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.alt_img')}}" name="alt_img" value="{{$about->alt_img}}">
                            </div>
                            
                            <div class="form-group col-md-2">
                                <label>{{trans('home.banner')}}</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> {{trans('home.upload')}}</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="banner">
                                        <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-1"> 
                                <label for="alt_banner">{{trans('home.alt_banner')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.alt_banner')}}" name="alt_banner" value="{{$about->alt_banner}}">
                            </div>

                           
                            <div class="form-group col-md-6">
                                @if($about->image)
                                    <img src="{{url('uploads/aboutStrucs/source/'.$about->image)}}" width="150">
                                @endif
                            </div>
                            
                            <div class="form-group col-md-6">
                                @if($about->banner)
                                    <img src="{{url('uploads/aboutStrucs/source/'.$about->banner)}}" width="150">
                                @endif
                            </div>
                            <br>
                            
                            <div class="form-group col-md-6 ">    
                                <fieldset class="form-group">
                                    <label for="text_en">{{trans('home.text_en')}}</label>
                                    <textarea class="form-control area1" placeholder="{{trans('home.text_en')}}" name="text_en">{!!$about->text_en!!}</textarea>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-6 ">    
                                <fieldset class="form-group">
                                    <label for="text_ar">{{trans('home.text_ar')}}</label>
                                    <textarea class="form-control area1" placeholder="{{trans('home.text_ar')}}" name="text_ar">{!!$about->text_ar!!}</textarea>
                                </fieldset>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    {!! Form::close() !!}
</div>

@endsection