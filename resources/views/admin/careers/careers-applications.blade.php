@extends('layouts.admin')
<title>{{trans('home.careerApplications')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.careerApplications')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.careerApplications')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.careerApplications')}}</h6>
                            <p class="text-muted card-sub-title">{{trans('home.table_contain_all_data_shortly_you_can_view_more_details')}}</p>
                        </div>

                        <div class="table-responsive">
                        <table class="table" id="exportexample">
                            <thead>
                                <tr>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.name')}}</th>
                                    <th>{{trans('home.email')}}</th>
                                    <th>{{trans('home.phone')}}</th>
                                    <th>{{trans('home.position')}}</th>
                                    <th>{{trans('home.career')}}</th>
                                    <th>{{trans('home.gender')}}</th>
                                    <th>{{trans('home.attached_file')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($careerApplications as $careerApplication)
                                    <tr>
                                        <td>{{$careerApplication->id}}</td>
                                        <td>{{$careerApplication->name}}</td>
                                        <td>{{$careerApplication->email}}</td>
                                        <td>{{$careerApplication->phone}}</td>
                                        <td>{{$careerApplication->position}}</td>
                                        <td><span class="badge badge-primary"> {{($careerApplication->career)? $careerApplication->career->title_en : ''}}</span></td>
                                        <td>{{$careerApplication->gender}}</td>
                                        <td><a href="{{url('uploads/careers/cvs/'.$careerApplication->cv_file)}}" target="_blank"><span class="badge badge-success">{{trans('home.download_cv')}}</span></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
					</div>
                    </div>



                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
@endsection
