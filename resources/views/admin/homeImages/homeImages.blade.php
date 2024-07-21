@extends('layouts.admin')
<title>{{trans('home.homeImages')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.homeImages')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.homeImages')}}</li>
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


        @foreach ($homeImages as $homeImage)
            <!-- Row-->
            <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card custom-card overflow-hidden">
        
                        <div class="card-body">
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.edit_image')}} {{$homeImage->id}}</h6>
                            </div>
                            {!! Form::open(['method'=>'PATCH','url' => 'admin/home-images/'.$homeImage->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                    <div class="col-md-4">
                                        <label>{{trans('home.image_en')}}</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> {{trans('home.upload')}}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="img_en">
                                                <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_img_en')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>{{trans('home.image_ar')}}</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> {{trans('home.upload')}}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="img_ar">
                                                <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_img_ar')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>{{trans('home.link')}}</label>
                                        <div class="input-group mb-3">
                                            <input aria-describedby="basic-addon2" name="link" class="form-control"  type="text" value="{{$homeImage->link}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">{{trans('home.link')}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($homeImage->img_en)
                                        <div class="col-md-4">
                                            <img src="{{url('\uploads\homeImages\resize200')}}\{{$homeImage->img_en}}" width="150">
                                        </div>
                                    @endif

                                    @if($homeImage->img_ar)
                                        <div class="col-md-4">
                                            <img src="{{url('\uploads\homeImages\resize200')}}\{{$homeImage->img_ar}}" width="150">
                                        </div>
                                    @endif
            
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.update')}} </button>
                                    </div>
                                    
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        @endforeach

    </div>
@endsection

