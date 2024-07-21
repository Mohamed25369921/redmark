@extends('layouts.admin')
<title>{{trans('home.edit_category')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.categories')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/categories')}}">{{trans('home.categories')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_category')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.edit_category')}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/categories/'.$category->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label class="">{{trans('home.name_en')}}</label>
                                    <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}"  value="{{$category->name_en}}" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="">{{trans('home.name_ar')}}</label>
                                    <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" value="{{$category->name_ar}}" >
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="parent">{{trans('home.parent')}}</label>
                                    <select class="form-control select2" name="parent_id">
                                        <option value="0">{{trans('home.no_parent')}}</option>
                                        @foreach($categories as $categ)
                                            <option value="{{$categ->id}}" {{($categ->id == $category->parent_id)?'selected':''}}>{{(app()->getLocale()=='en')? $categ->name_en:$categ->name_ar}}</option>
                                        @endforeach    
                                    </select>
                                </div>

                                <div class="col-md-6">
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
                                
                                <div class="col-md-6">
                                    <label>{{trans('home.banner')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="banner">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                        </div>
                                    </div>
                                </div>
                                

                                @if($category->image)
                                    <div class="col-md-6">
                                        <img src="{{url('\uploads\categories\resize200')}}\{{$category->image}}" width="150">
                                    </div>
                                @endif
                                
                                
                                @if($category->banner)
                                    <div class="col-md-6">
                                        <img src="{{url('\uploads\categories\resize200')}}\{{$category->banner}}" width="150">
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.desc_en')}}</label>
                                    <textarea class="form-control" name="desc_en" type="text" placeholder="{{trans('home.desc_en')}}" required>{{$category->desc_en}}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="">{{trans('home.desc_ar')}}</label>
                                    <textarea class="form-control" name="desc_ar" type="text" placeholder="{{trans('home.desc_ar')}}">{{$category->desc_ar}}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="status" value="1" {{($category->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                    </label>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="menu" value="1" {{($category->menu == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish_side_menu')}}</span>
                                    </label>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="home" value="1" {{($category->home == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish_in_home')}}</span>
                                    </label>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.en')}}</span>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label for="name_ar">{{trans('home.link')}}</label>
                                            <input type="text" autocomplete="off"  class="form-control" placeholder="{{trans('home.link')}}" name="link_en" value="{{$category->link_en}}">
                                        </div> 
                                            
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}">{{$category->meta_title_en}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}">{{$category->meta_desc_en}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label for="name_ar">{{trans('home.link')}}</label>
                                            <input type="text" autocomplete="off"  class="form-control" placeholder="{{trans('home.link')}}" name="link_ar" value="{{$category->link_ar}}">
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$category->meta_title_ar}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$category->meta_desc_ar}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="ckbox">
                                                <input name="meta_robots" value="1" {{($category->meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/categories')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
