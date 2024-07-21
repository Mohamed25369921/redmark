@extends('layouts.admin')
<title>{{trans('home.contactUsMessages')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.contactUsMessages')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.contactUsMessages')}}</li>
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
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.contactUsMessages')}}</h6>
                            <p class="text-muted card-sub-title">{{trans('home.table_contain_all_data_shortly_you_can_view_more_details')}}</p>
                        </div>

                        <div class="table-responsive">
                        <table class="table" id="exportexample">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"/></th>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.name')}}</th>
                                    <th>{{trans('home.email')}}</th>
                                    <th>{{trans('home.phone')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contactUsMessages as $contactUsMessage)
                                    <tr id="{{$contactUsMessage->id}}">
                                        <td> <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$contactUsMessage->id}}" /> </td>
                                        <td><a href="{{ route('contact-us-messages.edit', $contactUsMessage->id) }}">{{$contactUsMessage->id}}</a></td>
                                        <td><a href="{{ route('contact-us-messages.edit', $contactUsMessage->id) }}">{{$contactUsMessage->name}}</a></td>
                                        <td><a href="{{ route('contact-us-messages.edit', $contactUsMessage->id) }}">{{$contactUsMessage->email}}</a></td>
                                        <td><a href="{{ route('contact-us-messages.edit', $contactUsMessage->id) }}">{{$contactUsMessage->phone}}</a></td>
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
    </div>
@endsection
