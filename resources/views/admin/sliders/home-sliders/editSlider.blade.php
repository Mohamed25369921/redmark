@extends('layouts.admin')
<title>{{trans('home.edit_intro_sliders')}}</title>
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.intro_sliders')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/home-sliders')}}">{{trans('home.intro_sliders')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_slider')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['method'=>'PATCH','url' => 'admin/home-sliders/'.$slider->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">{{trans('home.edit_slider')}}</h6>
                        <hr>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label class="">{{trans('home.title')}}</label>
                            <input class="form-control" name="title" type="text" placeholder="{{trans('home.title')}}" value="{{$slider->title}}">
                        </div>
    
                        <div class="form-group  col-md-3">
                            <label>{{trans('home.image')}}</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> {{trans('home.upload')}}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image">
                                    <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="">{{trans('home.link')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">http://www.google.com</span>
                                </div>
                                <input type="text" class="form-control" name="link" placeholder="{{trans('home.link')}}"  value="{{$slider->link}}">
                            </div> 
                        </div>

                        <div class="form-group col-md-2">
                            <label for="helperText">{{trans('home.lang')}}</label>
                            <select class="form-control select2" name="lang" required>
                                <option value="en" {{($slider->lang == 'en')?'selected':''}}>{{trans('home.english')}}</option>
                                <option value="ar" {{($slider->lang == 'ar')?'selected':''}}>{{trans('home.arabic')}}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-1">
                            <label class="">{{trans('home.order')}}</label>
                            <input class="form-control" name="order" type="number" min="0" autocomplete="off" placeholder="{{trans('home.order')}}" value="{{$slider->order}}">
                        </div>    

                        @if($slider->image)
                            <div class="form-group  col-md-12">
                                <img src="{{url('\uploads\sliders\home-sliders\resize200')}}\{{$slider->image}}" width="350" height="150">                                    </div>
                            </div>
                        @endif

                        <div class="form-group col-md-12">
                            <label class="">{{trans('home.text')}}</label>
                            <textarea class="form-control" name="text"  placeholder="{{trans('home.text')}}">{!! $slider->text !!}</textarea>
                        </div>

                        <br>

                        <div class="form-group col-md-4">
                            <label class="ckbox">
                                <input name="status" value="1" {{($slider->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                            </label>
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
                            <a href="{{url('/admin/home-sliders')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
