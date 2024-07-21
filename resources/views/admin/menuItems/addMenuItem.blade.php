@extends('layouts.admin')

@section('meta')
    <title>{{trans('home.add_menu')}}</title>
@endsection
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.menu_items')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/menus')}}">{{trans('home.menu_items')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_menu')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['route' => 'menu-items.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">

                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.add_menu')}}</h6>
                            <hr>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_en')}}</label>
                                <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_ar')}}</label>
                                <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" required>
                            </div>

                            <div class="form-group col-md-3"> 
                                <label for="parent">{{trans('home.parent')}}</label>
                                <select class="form-control select2 parent" name="parent">
                                    <option value ="0">{{trans('home.no_parent')}}</option>
                                    @foreach($menuParents as $menuParent)
                                        <option value="{{$menuParent->id}}">@if(app()->getLocale() == 'en') {{ $menuParent->name_en}} @else {{ $menuParent->name_ar}} @endif</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3"> 
                                <fieldset class="form-group">
                                    <label for="order">{{trans('home.order')}}</label>
                                    <input type="number" min="1"  class="form-control" placeholder="{{trans('home.order')}}" name="order" required>
                                </fieldset>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="row"> 
                                    <div class="form-group col-md-4"> 
                                        <label for="menu">{{trans('home.menu')}}</label>
                                        <select class="form-control select2 menu" name="menu_id">
                                            @foreach($menus as $menu)
                                                <option value="{{$menu->id}}">{{(app()->getLocale() == 'en')?$menu->name_en:$menu->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4"> 
                                        <label for="menu_type">{{trans('home.menu_type')}}</label>
                                        <select class="form-control select2 menu_type" name="menu_type" required>
                                            <option></option>
                                            <option value="main-item">{{trans('home.main-item')}}</option>
                                            <option value="home">{{trans('home.home')}}</option>
                                            <option value="about-us">{{trans('home.about-us')}}</option>
                                            <option value="contact-us">{{trans('home.contact-us')}}</option>
                                            <option value="check-certificate">{{trans('home.checkCertificate')}}</option>
                                            <!--<option value="board-of-members">{{trans('home.boardofmembers')}}</option>-->
                                            <option value="category">{{trans('home.category')}}</option>
                                            <option value="categories">{{trans('home.categories')}}</option>
                                            <option value="projects">{{trans('home.projects')}}</option>
                                            <option value="project">{{trans('home.project')}}</option>
                                            <option value="services">{{trans('home.services')}}</option>
                                            <option value="service">{{trans('home.service')}}</option>
                                            <option value="galleryImages">{{trans('home.galleryImages')}}</option>
                                            <option value="galleryVideos">{{trans('home.galleryVideos')}}</option>
                                            <option value="brand">{{trans('home.brand')}}</option>
                                            <option value="developers">{{trans('home.brands')}}</option>
                                            <option value="pages">{{trans('home.pages')}}</option>
                                            <option value="blogs">{{trans('home.blogs')}}</option>
                                            <option value="blog-category">{{trans('home.blog-category')}}</option>
                                            <option value="blog-item">{{trans('home.blog-item')}}</option>
                                            <option value="careers">{{trans('home.careers')}}</option>
                                            <option value="training" >{{trans('home.trainings')}}</option>
                                            <option value="link">{{trans('home.link')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4"> 
                                        <div class="type_values">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="menu">{{trans('home.meta_keywords')}}</label>
                                <textarea class="form-control " name="meta_keywords" placeholder="{{trans('home.meta_keywords')}}" ></textarea>
                            </div>

                            <div class="form-group col-md-6"> 
                                <label for="menu">{{trans('home.meta_description')}}</label>
                                <textarea class="form-control " name="meta_description" placeholder="{{trans('home.meta_description')}}" ></textarea>
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
                        <div class="row">                    
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                <a href="{{url('/admin/menu-items')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
@section('script')
    <script>
        $('.status').select2();
        $('.menu').select2();
        $('.menu_type').select2({
            'placeholder' : "{{trans('home.choose_menu_type')}}",
        });
        $('.parent').select2();

        $('.menu_type').on('change',function(){
            var type = $('.menu_type option:selected').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{route('menuTypeValue')}}",
                method:'POST',
                data:{type:type},
                success:function(html)
                {
                    $('.type_values').html(html.html);
                    $('.type_value').select2();
                }
            });
        });
    </script>
@endsection