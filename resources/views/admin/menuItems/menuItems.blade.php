@extends('layouts.admin')
<title>{{trans('home.menu_items')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.menu_items')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.menu_items')}}</li>
                </ol>
            </div>

            <div class="btn btn-list">
                <a href="{{url('admin/menu-items/create')}}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
                <a id="btn_active"><button class="btn ripple btn-dark"><i class="fas fa-eye"></i> {{trans('home.publish/unpublish')}}</button></a>
                <a id="btn_delete" ><button class="btn ripple btn-danger"><i class="fas fa-trash"></i> {{trans('home.delete')}}</button></a>
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
                            <h6 class="card-title mb-1">{{trans('home.menu_items')}}</h6>
                            <p class="text-muted card-sub-title">{{trans('home.table_contain_all_data_shortly_you_can_view_more_details')}}</p>
                        </div>

                        <div class="table-responsive">
                        <table class="table" id="exportexample">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"/></th>
                                    <th>{{trans('home.id')}}</th>
                                    <th>{{trans('home.menu_name')}} {{ trans('home.en') }}</th>
                                    <th>{{trans('home.menu_name')}} {{ trans('home.ar') }}</th>
                                    <th>{{trans('home.menu_parent')}}</th>
                                    <th>{{trans('home.menu_order')}}</th>
                                    <th>{{trans('home.menu_type')}}</th>
                                    <th>{{trans('home.menu')}}</th>
                                    <th>{{trans('home.menu_status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuItems as $menuItem)
                                    <tr id="{{$menuItem->id}}">
                                        <td> <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$menuItem->id}}" /> </td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{{ $menuItem->id }}</td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{!! $menuItem->name_en !!}</a></td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{!! $menuItem->name_ar !!}</a></td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">@if($menuItem->parent) {{(app()->getLocale() == 'en')?$menuItem->parent->name_en:$menuItem->parent->name_ar }} @else {{trans('home.main_menu_item')}} @endif </td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{{ $menuItem->order }}</td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">{{ $menuItem->type }}</td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">@if($menuItem->Menu){{(app()->getLocale() == 'en')? $menuItem->Menu->name_en:$menuItem->Menu->name_ar }} @endif</td>
                                        <td><a href="{{ route('menu-items.edit',$menuItem->id) }}">@if($menuItem->status == 1) {{trans('home.published')}} @else {{trans('home.unpublished')}} @endif</td>
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
