@extends('layouts.admin')
<title>{{trans('home.add_permission')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.permissions')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/permissions')}}">{{trans('home.permissions')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_permission')}}</li>
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
                            <h6 class="card-title">{{trans('home.add_permission')}}</h6>
                        </div>
                        {!! Form::open(['route' => 'permissions.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="helperText">{{trans('home.name')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.name')}}" name="name" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/permissions')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
