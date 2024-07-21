@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_setting')}}</title>
@endsection
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.edit_setting')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_setting')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.edit_setting')}}</h6>
                            <hr>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/settings/'.$settings->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="helperText">{{trans('home.default_lang')}}</label>
                                    <select class="form-control select2" name="default_lang" required>
                                        <option value="en" {{ ($settings->default_lang=="en")?'selected':'' }}>{{trans('home.english')}}</option>
                                        <option value="ar" {{ ($settings->default_lang=="ar")?'selected':'' }}>{{trans('home.arabic')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-5">
                                    <label class="">{{trans('home.contact_email')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.contact_email')}}" name="contact_email" value="{{ $settings->contact_email }}">
                                </div>

                                <div class="form-group col-md-5">
                                    <label class="">{{trans('home.email')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.email')}}" name="email" value="{{ $settings->email }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.telphone')}}</label>
                                    <input type="number"  min="0" class="form-control" placeholder="{{trans('home.telphone')}}" name="telphone" value="{{ $settings->telphone }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.mobile')}}</label>
                                    <input type="mobile"  min="0" class="form-control" placeholder="{{trans('home.mobile')}}" name="mobile" value="{{ $settings->mobile }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.mobile2')}}</label>
                                    <input type="mobile"  min="0" class="form-control" placeholder="{{trans('home.mobile2')}}" name="mobile2" value="{{ $settings->mobile2 }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.fax')}}</label>
                                    <input type="fax"  min="0" class="form-control" placeholder="{{trans('home.fax')}}" name="fax" value="{{ $settings->fax }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.whatsapp')}}</label>
                                    <input type="whatsapp"  min="0" class="form-control" placeholder="{{trans('home.whatsapp')}}" name="whatsapp" value="{{ $settings->whatsapp }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="facebook">{{trans('home.facebook')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.facebook')}}" name="facebook" value="{{ $settings->facebook }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="twitter">{{trans('home.twitter')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.twitter')}}" name="twitter" value="{{ $settings->twitter }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="instgram">{{trans('home.instagram')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.instagram')}}" name="instgram" value="{{ $settings->instgram }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="linkedin">{{trans('home.linkedin')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.linkedin')}}" name="linkedin" value="{{ $settings->linkedin }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.snapchat')}}</label>
                                    <input type="text"  min="0" class="form-control" placeholder="{{trans('home.snapchat')}}" name="snapchat" value="{{ $settings->snapchat }}">
                                </div>

                                
                                <div class="form-group col-md-3">
                                    <label for="tiktok">{{trans('home.tiktok')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.tiktok')}}" name="tiktok" value="{{ $settings->tiktok }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="youtube">{{trans('home.youtube')}}</label>
                                    <input type="text" class="form-control" placeholder="{{trans('home.youtube')}}" name="youtube" value="{{ $settings->youtube }}">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>{{trans('home.map_url')}}</label>
                                    <textarea class="form-control" name="map_url" type="text" placeholder="{{trans('home.map_url')}}">{{$settings->map_url}}</textarea>
                                </div>
                                
                                <div class="form-group col-md-12 ">
                                    <iframe src="{{$settings->map_url}}" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                
                                {{--<div class="form-group col-md-6">
                                    <label for="latitude">{{trans('home.latitude')}}</label>
                                    <input type="text"  placeholder="{{ trans('home.latitude') }}" id="latitude" class="form-control" name="lat" value="{{ $settings->lat }}" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="longitude">{{trans('home.longitude')}}</label>
                                    <input type="text" id="longitude" class="form-control" placeholder="{{trans('home.longitude')}}" name="lng" value="{{ $settings->lng }}" readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="map">{{trans('home.map')}}</label>
                                    <div id="map-canvas" style="height: 350px; margin-bottom: 15px;"></div>
                                </div>--}}
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.cetificates')}}</label>
                                    <input type="number"  min="0" class="form-control" placeholder="{{trans('home.cetificates')}}" name="cetificates" value="{{ $settings->cetificates }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.exp_years')}}</label>
                                    <input type="number"  min="0" class="form-control" placeholder="{{trans('home.exp_years')}}" name="exp_years" value="{{ $settings->exp_years }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.surgeries')}}</label>
                                    <input type="number"  min="0" class="form-control" placeholder="{{trans('home.surgeries')}}" name="surgeries" value="{{ $settings->surgeries }}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label class="">{{trans('home.consult')}}</label>
                                    <input type="number"  min="0" class="form-control" placeholder="{{trans('home.consult')}}" name="consult" value="{{ $settings->consult }}">
                                </div>
                                
                                
                                 <div class="col-md-3">
                                    <label>{{trans('home.about_banner')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="about_banner">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label>{{trans('home.contact_banner')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="contact_banner">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label>{{trans('home.blogs_banner')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="blogs_banner">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label>{{trans('home.certificate_banner')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="certificate_banner">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_banner')}}</label>
                                        </div>
                                    </div>
                                </div>

                                @if($settings->about_banner)
                                    <div class="col-md-3">
                                        <img src="{{url('\uploads\settings\source')}}\{{$settings->about_banner}}" width="150">
                                    </div>
                                @endif
                                
                                @if($settings->contact_banner)
                                    <div class="col-md-3">
                                        <img src="{{url('\uploads\settings\source')}}\{{$settings->contact_banner}}" width="150">
                                    </div>
                                @endif
                                
                                
                                @if($settings->blogs_banner)
                                    <div class="col-md-3">
                                        <img src="{{url('\uploads\settings\source')}}\{{$settings->blogs_banner}}" width="150">
                                    </div>
                                @endif
                                
                                @if($settings->certificate_banner)
                                    <div class="col-md-3">
                                        <img src="{{url('\uploads\settings\source')}}\{{$settings->certificate_banner}}" width="150">
                                    </div>
                                @endif
                                
                                <br>
                                <hr>
                                
                                <div class="form-group col-md-6">
                                    <label for="gtm_script">{{trans('home.gtm_script')}}</label>
                                    <textarea class="form-control" placeholder="{{trans('home.gtm_script')}}" name="gtm_script"> {!! $settings->gtm_script !!}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="gtm_noscript">{{trans('home.gtm_noscript')}}</label>
                                    <textarea class="form-control" placeholder="{{trans('home.gtm_noscript')}}" name="gtm_noscript"> {!! $settings->gtm_noscript !!}</textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label class="ckbox">
                                        <input name="publish_gtm_script" value="1" {{($settings->publish_gtm_script == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish_gtm_script')}}</span>
                                    </label>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label class="ckbox">
                                        <input name="publish_contact_modal" value="1" {{($settings->publish_contact_modal == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish_contact_modal')}}</span>
                                    </label>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2DM4_HwOA3s6WsWcyhRt5Q_NO9CoxZpU&callback=initMap2" async defer></script>
    <script>

        $('.lang').select2({
        });

    </script>
@endsection