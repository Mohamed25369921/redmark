@extends('layouts.admin')
<title>{{trans('home.add_brand')}}</title>
@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.brands')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/brands')}}">{{trans('home.brands')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_brand')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['route' => 'brands.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.add_brand')}}</h6>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="">{{trans('home.name_en')}}</label>
                                <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="">{{trans('home.name_ar')}}</label>
                                <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label>{{trans('home.logo')}}</label>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> {{trans('home.upload')}}</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="logo">
                                        <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_logo')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="ckbox">
                                    <input name="status" value="1" type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
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
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.seo_block')}}</h6>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label for="name_ar">{{trans('home.link')}}</label>
                                        <input type="text" autocomplete="off"  class="form-control" placeholder="{{trans('home.link')}}" name="link_en">
                                    </div> 
                                        
                                    <div class="form-group col-md-5">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}"></textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-5">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <hr>
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    </div>
                                    
                                    <div class="form-group col-md-2">
                                        <label for="name_ar">{{trans('home.link')}}</label>
                                        <input type="text" autocomplete="off"  class="form-control" placeholder="{{trans('home.link')}}" name="link_ar">
                                    </div>
                                    
                                    <div class="form-group col-md-5">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}"></textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-5">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="meta_robots" value="1" type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
                                        </label>
                                    </div>
                                </div>
                            <div>
                        </div>                                
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
                                <a href="{{url('/admin/brands')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

