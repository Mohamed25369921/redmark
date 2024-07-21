@extends('layouts.admin')
<title>{{trans('home.certificateExcel')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.certificateExcel')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.certificateExcel')}}</li>
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

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
    
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.certificateExcel')}}</h6>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['method'=>'POST','url' => 'admin/saveCertificateRecords', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>{{trans('home.choose_excel_sheet')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="excel_file">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_excel_sheet')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    
                    @if(count($records)>0)
                        <div class="card-body">
                            <div>
                                <h6 class="card-title mb-1">{{trans('home.certificates')}}</h6>
                            </div>
    
                            <div class="table-responsive">
                                <table class="table" id="exportexample">
                                    <thead>
                                        <tr>
                                            <th>{{trans('home.id')}}</th>
                                            <th>{{trans('home.name')}}</th>
                                            <th>{{trans('home.course')}}</th>
                                            <th>{{trans('home.certificate_id')}}</th>
                                            <th>{{trans('home.place')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->name}}</td>
                                                <td>{{$record->course}}</td>
                                                <td>{{$record->certificate_id}}</td>
                                                <td>{{$record->place}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
        					</div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection