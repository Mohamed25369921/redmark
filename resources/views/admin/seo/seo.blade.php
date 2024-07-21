@extends('layouts.admin')
<title>{{trans('home.seo_assistant')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.seo_assistant')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.seo_assistant')}}</li>
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

        {!! Form::open(['method'=>'PATCH','url' => 'admin/seo-assistant/'.$seo->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
            <!-- Row-->
                <div class="row">
                    <div class="col-sm-12 col-xl-12 col-lg-12">
                        <div class="card custom-card overflow-hidden">
            
                            <div class="card-body">
                                <div>
                                    <h6 class="card-title mb-1">{{trans('home.home_page')}}</h6>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="home_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->home_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="home_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->home_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="home_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->home_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="home_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->home_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="home_meta_robots" value="1" {{($seo->home_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                    <h6 class="card-title mb-1">{{trans('home.about_us')}}</h6>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="about_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->about_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="about_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->about_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="about_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->about_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="about_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->about_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="about_meta_robots" value="1" {{($seo->about_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                    <h6 class="card-title mb-1">{{trans('home.contact_us')}}</h6>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="contact_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->contact_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="contact_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->contact_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="contact_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->contact_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="contact_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->contact_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="contact_meta_robots" value="1" {{($seo->contact_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                    <h6 class="card-title mb-1">{{trans('home.galleryImages')}}</h6>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="gallery_images_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_images_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="gallery_images_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_images_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="gallery_images_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_images_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="gallery_images_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_images_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="gallery_images_meta_robots" value="1" {{($seo->gallery_images_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                    <h6 class="card-title mb-1">{{trans('home.galleryVideos')}}</h6>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="gallery_videos_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_videos_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="gallery_videos_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_videos_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="gallery_videos_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->gallery_videos_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="gallery_videos_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->gallery_videos_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="gallery_videos_meta_robots" value="1" {{($seo->gallery_videos_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                    <h6 class="card-title mb-1">{{trans('home.services')}}</h6>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.en')}}</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="services_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->services_meta_title}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="services_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->services_meta_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                        <textarea class="form-control" name="services_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->services_meta_title_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                        <textarea class="form-control" name="services_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->services_meta_desc_ar}}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="services_meta_robots" value="1" {{($seo->services_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                <h6 class="card-title mb-1">{{trans('home.blogs')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="blogs_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->blogs_meta_title}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="blogs_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->blogs_meta_desc}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="blogs_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->blogs_meta_title_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="blogs_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->blogs_meta_desc_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label class="ckbox">
                                        <input name="blogs_meta_robots" value="1" {{($seo->blogs_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                <h6 class="card-title mb-1">{{trans('home.categories')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="categories_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->categories_meta_title}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="categories_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->categories_meta_desc}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="categories_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->categories_meta_title_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="categories_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->categories_meta_desc_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label class="ckbox">
                                        <input name="categories_meta_robots" value="1" {{($seo->categories_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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
                                <h6 class="card-title mb-1">{{trans('home.brands')}}</h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.en')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="brands_meta_title" placeholder="{{trans('home.meta_title')}}">{{$seo->brands_meta_title}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="brands_meta_desc" placeholder="{{trans('home.meta_desc')}}">{{$seo->brands_meta_desc}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <span class="badge badge-success">{{trans('home.ar')}}</span>
                                    <hr>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                    <textarea class="form-control" name="brands_meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$seo->brands_meta_title_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                    <textarea class="form-control" name="brands_meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$seo->brands_meta_desc_ar}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label class="ckbox">
                                        <input name="brands_meta_robots" value="1" {{($seo->brands_meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
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