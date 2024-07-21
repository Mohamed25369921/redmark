@extends('layouts.admin')
<title>{{trans('home.contactUsMessage')}}</title>
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.contactUsMessages')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/countries')}}">{{trans('home.contactUsMessages')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.contactUsMessage')}}</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row-->
        <div class="row">

            <div class="ol-sm-12 col-xl-12 col-lg-12">
				<div class="card custom-card">
					<div class="">
						<div class="main-content-body main-content-body-contacts">
							<div class="main-contact-info-header pt-3">
								<div class="media">
									<div class="main-img-user">
										<img alt="avatar" src="{{url('resources/assets/back/img/users/1.jpg')}}">
									</div>
									<div class="media-body">
										<h4>{{$contactUsMessage->name}}</h4>
									</div>
								</div>
							</div>
							<div class="main-contact-info-body">
								<div>
									<h6>{{trans('home.contactUsMessage')}}</h6>
									<p>{{$contactUsMessage->message}}</p>
								</div>
								<div class="media-list">
									<div class="media">
										<div class="media-body">
											<div>
												<label>{{trans('home.email')}}</label> <span class="tx-medium">{{$contactUsMessage->email}}</span>
											</div>
											<div>
												<label>{{trans('home.phone')}}</label> <span class="tx-medium">{{$contactUsMessage->phone}}</span>
											</div>
											<div>
												<label>{{trans('home.service')}}</label> <span class="tx-medium">{{$contactUsMessage->service}}</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!-- End Row -->
    </div>

@endsection
