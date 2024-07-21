@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.add_career')}}</title>
@endsection
@section('content')

<div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.careers')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/careers')}}">{{trans('home.careers')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_career')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.add_career')}}</h6>
                        </div>
                        {!! Form::open(['route' => 'careers.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label class="">{{trans('home.title_en')}}</label>
                                    <input class="form-control" name="title_en" type="text" placeholder="{{trans('home.title_en')}}" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="">{{trans('home.title_ar')}}</label>
                                    <input class="form-control" name="title_ar" type="text" placeholder="{{trans('home.title_ar')}}" required>
                                </div>

                                <div class="col-md-4">
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

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.desc_en')}}</label>
                                    <textarea class="form-control area1" name="desc_en" type="text" placeholder="{{trans('home.desc_en')}}"></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.desc_ar')}}</label>
                                    <textarea class="form-control area1" name="desc_ar" type="text" placeholder="{{trans('home.desc_ar')}}"></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.responsibilities_en')}}</label>
                                    <textarea class="form-control area1" name="responsibilities_en" type="text" placeholder="{{trans('home.responsibilities_en')}}"></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.responsibilities_ar')}}</label>
                                    <textarea class="form-control area1" name="responsibilities_ar" type="text" placeholder="{{trans('home.responsibilities_ar')}}"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="ckbox">
                                        <input name="status" value="1" type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                    </label>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/careers')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

