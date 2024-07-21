@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_writer')}}</title>
@endsection
@section('content')

<div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.writers')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/writers')}}">{{trans('home.writers')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_writer')}}</li>
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
                            <h6 class="card-title ">{{trans('home.edit_writer')}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/writers/'.$writer->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="name">{{trans('home.name')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name')}}" name="name"value="{{$writer->name}}" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="email">{{trans('home.email')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.email')}}" name="email"value="{{$writer->email}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">{{trans('home.phone')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.phone')}}" name="phone"value="{{$writer->phone}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="position">{{trans('home.position')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.position')}}" name="position"value="{{$writer->position}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="facebook">{{trans('home.facebook')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.facebook')}}" name="facebook"value="{{$writer->facebook}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="linkedin">{{trans('home.linkedin')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.linkedin')}}" name="linkedin"value="{{$writer->linkedin}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="instgram">{{trans('home.instgram')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.instgram')}}" name="instgram"value="{{$writer->instgram}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="twitter">{{trans('home.twitter')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.twitter')}}" name="twitter"value="{{$writer->twitter}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>{{trans('home.image')}}</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> {{trans('home.upload')}}</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image">
                                                <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if($writer->image)
                                        <div class="form-group">
                                            <img src="{{url('\uploads\aboutStrucs\resize200')}}\{{$writer->image}}" width="150">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-9 ">    
                                    <fieldset class="form-group">
                                        <label for="aboutWriter">{{trans('home.aboutWriter')}}</label>
                                        <textarea class="form-control" placeholder="{{trans('home.aboutWriter')}}" name="aboutWriter">{!! $writer->aboutWriter !!}</textarea>
                                    </fieldset>
                                </div>


                                <div class="form-group col-md-12">
                                    <label class="ckbox">
                                        <input name="status" value="1" {{($writer->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                    </label>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/writers')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

