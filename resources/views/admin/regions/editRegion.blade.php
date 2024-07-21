@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_region')}}</title>
@endsection
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.regions')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/regions')}}">{{trans('home.regions')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_region')}}</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    {!! Form::open(['method'=>'PATCH','url' => 'admin/regions/'.$region->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
    <!-- Row-->
    <div class="row">
        <div class="col-sm-12 col-xl-12 col-lg-12">
            <div class="card custom-card overflow-hidden">

                <div class="card-body">
                    <div>
                        <h6 class="card-title mb-1">{{trans('home.edit_region')}}</h6>
                        <hr>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label class="">{{trans('home.name_en')}}</label>
                            <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}"  value="{{$region->name_en}}" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="">{{trans('home.name_ar')}}</label>
                            <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}" value="{{$region->name_ar}}" >
                        </div>

                        <div class="form-group col-md-4">
                            <label for="parent">{{trans('home.country')}}</label>
                            <select class="form-control select2" name="country_id">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{($country->id == $region->country_id)?'selected':''}}>{{(app()->getLocale()=='en')? $country->name_en:$country->name_ar}}</option>
                                @endforeach    
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="ckbox">
                                <input name="status" value="1" {{($region->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                            </label>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="ckbox">
                                <input name="available_units" value="1" {{($region->available_units == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.available_units')}}</span>
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
                            <a href="{{url('/admin/regions')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
