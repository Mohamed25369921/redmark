@extends('layouts.admin')
<title>{{trans("home.edit_user")}}</title>
@section('content')

    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.users')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/roles')}}">{{trans('home.users')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_user')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.edit_user')}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/users/'.$user->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="helperText">{{trans('home.f_name')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.f_name')}}" value="{{ $user->f_name }}" name="f_name"  required>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="helperText">{{trans('home.l_name')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.l_name')}}" value="{{ $user->l_name }}" name="l_name"  required>
                                </div>

                                <div class="form-group col-md-3">
                                        <label for="helperText">{{trans('home.email')}}</label>
                                        <input type="email" class="form-control email" placeholder="{{trans('home.email')}}" value="{{ $user->email }}" name="email"  required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="helperText">{{trans('home.password')}}</label>
                                    <input type="password" class="form-control" placeholder="{{trans('home.password')}}" name="password" data-minlength="8">
                                    <p><code>{{trans('home.Your Password Must Be at Least 6 Characters')}}</code></p>
                                </div>

                                <div class="form-group col-md-6">
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
                                    <fieldset class="form-group">
                                        <label for="phone1">{{trans('home.phone')}}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                            </div>
                                            <input type="number" min="0" class="form-control" placeholder="{{trans('home.phone')}}" name="phone" autocomplete="off" required value="{{$user->phone}}">
                                        </div>
                                    </fieldset>
                                </div>

                                @if($user->image)
                                    <div class="form-group col-md-12">                                        
                                    <label>{{trans('home.image')}}</label><br>
                                        <img src="{{url('\uploads\users\resize200')}}\{{$user->image}}" width="150">
                                    </div>
                                @endif

                                <div class="form-group col-md-6">
                                    <label for="helperText">{{trans('home.roles')}}</label>
                                    <select class="form-control role select2" name="role[]" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}" @if(in_array($role->name,$userRoles)) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">            
                                    <label for="helperText">{{trans('home.admin')}}</label>
                                    <select class="form-control admin select2" name="admin">
                                        <option value="1" @if($user->is_admin == 1) selected @endif>{{trans('home.yes')}}</option>
                                        <option value="0" @if($user->is_admin == 0) selected @endif>{{trans('home.no')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/users')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
        $('.role').select2({
            placeholder: 'Select Roles'
        });

        $('.admin').select2();

        $(".email").attr("autocomplete","off");
        
        $(".img").fileinput({showUpload:false, previewFileType:'any' ,theme: 'fa'});
    </script>
@endsection