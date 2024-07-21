@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.add_blog_category')}}</title>
@endsection

@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.blogCategories')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/blog-categories')}}">{{trans('home.blogCategories')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_blog_category')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['route' => 'blog-categories.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    
                    <div class="card-body">
                        <div>
                            <h6 class="card-title ">{{trans('home.add_blog_category')}}</h6>
                            <hr>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="title_en">{{trans('home.title_en')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.title_en')}}" name="title_en" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title_ar">{{trans('home.title_ar')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.title_ar')}}" name="title_ar">
                            </div>


                            <div class="form-group col-md-6 ">
                                <label for="text_en">{{trans('home.text_en')}}</label>
                                <textarea class="form-control area1" name="text_en" placeholder="{{trans('home.text_en')}}" ></textarea>
                            </div>

                            <div class="form-group col-md-6 "> 
                                <label for="text_ar">{{trans('home.text_ar')}}</label>
                                <textarea class="form-control area1" name="text_ar" placeholder="{{trans('home.text_ar')}}" ></textarea>
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
                        <h6 class="card-title ">{{trans('home.seo_block')}}</h6>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <hr>
                            <span class="badge badge-success">{{trans('home.en')}}</span>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label for="link_en">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en">
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
                            <label for="link_ar">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar">
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
                            <a href="{{url('/admin/blog-categories')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

