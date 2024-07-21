@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.add_project')}}</title>
@endsection
@section('content')

<div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.projects')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a hr ef="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/projects')}}">{{trans('home.projects')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_project')}}</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->
        {!! Form::open(['route' => 'projects.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
            <!-- Row-->
            <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        
                        <div class="card-body">
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.add_project')}}</h6>
                                <hr>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.name_en')}}</label>
                                    <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.name_ar')}}</label>
                                    <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label>{{trans('home.main_image')}}</label>
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
                                
                                <div class="form-group col-md-2">
                                    <label for="alt_img"> {{trans('home.alt_img')}}</label>
                                    <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="helperText">{{trans('home.category')}}</label>
                                    <select class="form-control select2" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{(app()->getLocale() == 'en')?$category->name_en:$category->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="helperText">{{trans('home.brand')}}</label>
                                    <select class="form-control select2" name="brand_id" required>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{(app()->getLocale() == 'en')?$brand->name_en:$brand->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- End Row -->            
             <!-- Row-->
             <div class="row">
                <div class="col-sm-12 col-xl-12 col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div class="row">    
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save_and_continue')}} </button>
                                    <a href="{{url('/admin/projects')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

