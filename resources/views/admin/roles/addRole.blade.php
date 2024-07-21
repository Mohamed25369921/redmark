@extends('layouts.admin')
<title>{{trans('home.add_role')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.roles')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/roles')}}">{{trans('home.roles')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_   ')}}</li>
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
                            <h6 class="card-title">{{trans('home.add_role')}}</h6>
                        </div>
                        {!! Form::open(['route' => 'roles.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">
                                <div class="col-md-12 form-group">   
                                    <label for="name">{{trans('home.name')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name')}}" name="name" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="helperText">{{trans('home.permissions')}}</label>
                                    <select class="form-control permissions select2" name="permissions[]" multiple>
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->name}}" >{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <input type="checkbox" id="checkbox">  {{trans('home.selectall')}}
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/roles')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

@section('script')
    <script>
        $('.permissions').select2({
            placeholder: 'Select permissions'
        });

        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $(".select2 > option").prop("selected",true);
                $(".select2").trigger("change");
            }else{
                $('.select2 option:selected').prop("selected", false);
                $(".select2").trigger("change");
            }select2
        });

    </script>
@endsection