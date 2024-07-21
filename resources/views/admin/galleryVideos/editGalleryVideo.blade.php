@extends('layouts.admin')
<title>{{trans('home.edit_galleryVideo')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.galleryVideos')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/gallery-videos')}}">{{trans('home.galleryVideos')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_galleryVideo')}}</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">

                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.edit_galleryVideo')}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/gallery-videos/'.$galleryVideo->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-9">
                                    <fieldset class="form-group">
                                        <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                        <input type="text"  class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link" value="{{$galleryVideo->youtube_link}}" required>
                                    </fieldset>
                                </div>

                                <div class="form-group col-md-3">
                                    <fieldset class="form-group">
                                        <label for="order">{{trans('home.order')}}</label>
                                        <input type="number" min="1"  class="form-control" placeholder="{{trans('home.order')}}" name="order" value="{{$galleryVideo->order}}" >
                                    </fieldset>
                                </div>
                            
                                <div class="form-group col-md-12">
                                    <iframe width="986" height="350"
                                        src="{{$galleryVideo->youtube_link}}">
                                    </iframe>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="text_en">{{trans('home.text_en')}}</label>
                                    <textarea class="form-control " name="text_en" placeholder="{{trans('home.text_en')}}" maxlength="50">{{$galleryVideo->text_en}}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="text_ar">{{trans('home.text_ar')}}</label>
                                    <textarea class="form-control " name="text_ar" placeholder="{{trans('home.text_ar')}}" maxlength="50">{{$galleryVideo->text_ar}}</textarea>
                                </div>

                                <div class="form-group col-md-12">
                                  <label class="ckbox">
                                      <input name="status" value="1" {{($galleryVideo->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                  </label>
                              </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/gallery-videos')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
