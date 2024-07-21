@extends('layouts.vendor')
<title>{{trans('home.vendor_board')}}</title>
@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->pull('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="page error-bg main-error-wrapper">
    <div class="row align-items-center d-flex flex-row">
        <div class="col-lg-6 pr-lg-4 tx-lg-right">
            <h3 class="display-1 mb-0">{{trans("home.$vendor->status")}}</h3>
        </div>
        <div class="col-lg-6 tx-lg-left">
            <h2>{{trans('home.account_summary')}}</h2>
            @if($vendor->status == 'under_review')
                <h6>{{trans('home.Your Account is under review and will be in confirmed in 48 hours form your registeration thank you')}}</h6>
            @else
                <h6>{{trans('home.Your Account is blocked please contact our customer support')}}</h6>
            @endif
        </div>
    </div>
</div>

@endsection
