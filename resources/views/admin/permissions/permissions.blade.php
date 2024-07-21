@extends('layouts.admin')
<title>{{trans('home.permissions')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.permissions')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.permissions')}}</li>
                </ol>
            </div>

            <div class="btn btn-list">
                <a href="{{url('admin/permissions/create')}}" class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</a>
                <a id="btn_delete" class="btn ripple btn-danger"><i class="fas fa-trash"></i> {{trans('home.delete')}}</a>
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
                            <h6 class="card-title mb-1">{{trans('home.permissions')}}</h6>
                            <p class="text-muted card-sub-title">{{trans('home.table_contain_all_data_shortly_you_can_view_more_details')}}</p>
                        </div>

                        <div class="table-responsive">
                        <table class="table" id="exportexample">
                            <thead>
                                <tr>
                                    <th><label class="ckbox"><input type="checkbox" id="checkAll"/><span></span></label></th>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.permission_name')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr id="{{$permission->id}}">
                                        <td> <label class="ckbox"><input type="checkbox" name="checkbox"  class="tableChecked" value="{{$permission->id}}"/><span></span></label></td>
                                        <td><a href="{{ route('permissions.edit', $permission->id) }}">{{$permission->id}}</a></td>
                                        <td><a href="{{ route('permissions.edit', $permission->id) }}">{{$permission->name}}</a></td>
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
