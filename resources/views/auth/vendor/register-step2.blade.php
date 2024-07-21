@extends('layouts.app')
<title>{{trans('home.register_as_vendor')}}</title>
@section('content')
<div class="spainer"> </div>
<section id="sign">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{trans('home.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.register_as_vendor')}}</li>
            </ol>
        </nav>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="step2" method="POST" action="{{ url('vendor-board/saveVendorRegisterData/'.$vendor->id) }}" enctype="multipart/form-data">
            @csrf
            <h2 class="center-title main">{{trans('home.register_as_vendor')}}</h2>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="email">{{trans('home.commercial_name')}}</label>
                    <input type="text" name="commercial_name" id="commercial_name" class="form-control" placeholder="{{trans('home.commercial_name')}}" value="{{ old('commercial_name') }}" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="email">{{trans('home.ssn')}}</label>
                    <input class="form-control"  name="ssn" placeholder="{{trans('home.ssn')}}" type="text" value="{{ old('ssn') }}" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="email">{{trans('home.logo')}}</label>
                    <div class="custom-file">
                        <input class="custom-file-input" name="logo" type="file" required> 
                        <label class="custom-file-label" name="logo" for="customFile">{{trans('home.choose_file')}}</label>
                    </div>
                </div>    

                <div class="form-group col-md-6">
                    <label for="phone1">{{trans('home.phone1')}}</label>
                    <input class="form-control phoneMask" name="phone1" placeholder="{{trans('home.phone1')}}" type="number" min="0" value="{{ old('phone1') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="phone2">{{trans('home.phone2')}}</label>
                    <input class="form-control phoneMask" name="phone2" placeholder="{{trans('home.phone2')}}" value="{{ old('phone2') }}" type="number"  min="0">
                </div>


                <div class="form-group col-md-6">
                    <label for="address1">{{trans('home.address1')}}</label>
                    <input type="text" name="address1" id="address1" class="form-control" placeholder="{{trans('home.address1')}}"  value="{{ old('address1') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="address2">{{trans('home.address2')}}</label>
                    <input type="text" name="address2" id="address2" class="form-control" placeholder="{{trans('home.address2')}}" value="{{ old('address2') }}" >
                </div>

                <div class="form-group col-md-4">
                    <label for="country">{{trans('home.country')}}</label>
                    <select class="form-control select2 country" name="country_id" required>
                        <option></option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{(app()->getLocale()=='en')? $country->name_en:$country->name_ar}}</option>
                        @endforeach    
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="region">{{trans('home.region')}}</label>
                    <select class="form-control select2 region" name="region_id" required>

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="area">{{trans('home.area')}}</label>
                    <select class="form-control select2 area" name="area_id" required>

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="lat">{{trans('home.lat')}}</label>
                    <input type="text"  placeholder="{{ trans('home.lat') }}" id="latitude" class="form-control" name="lat"  value="{{ old('lat') }}" readonly required>
                </div>

                <div class="form-group col-md-6">
                    <label for="lng">{{trans('home.lng')}}</label>
                    <input type="text" id="longitude" class="form-control" placeholder="{{trans('home.lng')}}" name="lng"  value="{{ old('lng') }}" readonly required>
                </div>

                <div class="form-group col-md-12">
                    <label for="map">{{trans('home.map')}} ({{trans('home.press_on_map_to_pick_your_location')}})</label>
                    <div id="map-canvas" style="height: 350px; margin-bottom: 15px;"></div>
                </div>

                <div class="form-group col-md-12">
                    <label for="area">{{trans('home.vendor_type')}}</label>
                    <select class="form-control select2 vendor_type" name="type" required>
                        <option value="individual">{{trans('home.individual')}}</option>
                        <option value="company">{{trans('home.company')}}</option>
                    </select>
                </div>

                <div class="form-group col-md-12 company-vendor">

                </div>

                <div class="form-group col-md-12 text-center">
                    <button class="btn ripple btn-main-primary main-btn">{{trans('home.save')}}</button>
                </div>
            </div> 
        </form> 

    </div>
</section>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2DM4_HwOA3s6WsWcyhRt5Q_NO9CoxZpU&callback=initMap1" async defer></script>

    <script>

        $('.country').select2({
            'placeholder':'{{trans("home.countries")}}'
        });

        $('.region').select2({
            'placeholder':'{{trans("home.regions")}}'
        });

        $('.area').select2({
            'placeholder':'{{trans("home.areas")}}'
        });

        $('.vendor_type').select2({
            'placeholder':'{{trans("home.vendor_type")}}'
        });


        $(function() {
            $('.phoneMask').mask('(999) 9999-9999');
            $('.ssnMask').mask('9-999999-9999999');
        });

        $('.country').change(function () {
            var id = $(this).val();
            var region = $('.region');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('getRegions')  }}',
                data: {id: id},
                success: function( data ) {
                    var html = '';
                    html += '<option></option>'
                    for(var i=0;i<data.length;i++){
                        html += '<option  value="'+ data[i].id +'">@if(\App::getLocale() == 'en')'+ data[i].name_en +' @else '+ data[i].name_ar +' @endif</option>';
                    }
                    region.html(html);
                }
            });
        });

        $('.region').change(function () {
            var id = $(this).val();
            var area = $('.area');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('getAreas')  }}',
                data: {id: id},
                success: function( data ) {
                    var html = '';
                    html += '<option></option>'
                    for(var i=0;i<data.length;i++){
                        html += '<option  value="'+ data[i].id +'">@if(\App::getLocale() == 'en')'+ data[i].name_en +' @else '+ data[i].name_ar +' @endif</option>';
                    }
                    area.html(html);
                }
            });
        });

        $('.vendor_type').change(function () {
            var type = $(this).val();

            if(type ==='individual'){
                var html = '';
                $('.company-vendor').html(html);
            }else{
                console.log('fff');
                var html = '';
                html+='<div class="row"><div class="form-group col-md-6"><label for="commercial_reg_num">{{trans('home.commercial_reg_num')}}</label><input type="number" min="0" name="commercial_reg_num"  class="form-control" placeholder="{{trans('home.commercial_reg_num')}}" required></div>'
                html+='<div class="form-group col-md-6"><label for="email">{{trans('home.commercial_reg_pdf')}}</label><div class="custom-file"><input class="custom-file-input" name="commercial_reg_pdf" type="file" required><label class="custom-file-label" name="commercial_reg_pdf" for="customFile">{{trans('home.choose_file')}}</label></div></div>'  
                html+='<div class="form-group col-md-6"><label for="tax_reg_number  ">{{trans('home.tax_reg_number')}}</label><input type="number" min="0" name="tax_reg_number"  class="form-control" placeholder="{{trans('home.tax_reg_number')}}" required></div>'
                html+='<div class="form-group col-md-6"><label for="email">{{trans('home.tax_reg_pdf')}}</label><div class="custom-file"><input class="custom-file-input" name="tax_reg_pdf" type="file" required><label class="custom-file-label" name="tax_reg_pdf" for="customFile">{{trans('home.choose_file')}}</label></div></div></div>'  
     
                $('.company-vendor').html(html);
            }
        });
    

    </script>
@endsection
