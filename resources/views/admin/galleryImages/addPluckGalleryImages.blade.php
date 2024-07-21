@extends('layouts.admin')
<title>{{trans('home.add_galleryImage')}}</title>

@section('style')
<style>
    img {
        display:block !important;
    }
    .dz-hidden-input{
        position: absolute !important;
        top: 0px !important;
        left: 250px !important;
    }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.galleryImages')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/gallery-images')}}">{{trans('home.galleryImages')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_galleryImage')}}</li>
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
                            <h6 class="card-title mb-1">{{trans('home.add_galleryImages')}}</h6>
                        </div>
                        {!! Form::open(['url' => 'admin/gallery-images/storePluck', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">
                                
                                <div class="form-group col-md-12">
                                    <hr>
                                    <label for="images">{{trans('home.images')}}</label>
                                        <div class="dropzone col-md-12 upload_images">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/gallery-images')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
    
    <script type="text/javascript">

        var token = "{{ csrf_token() }}";
        //Dropzone.autoDiscover = true;
        Dropzone.autoDiscover = false;

        $("div.upload_images").dropzone({
            
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp",
            url: "{{ URL::to('admin/gallery-images/uploadImages') }}",

            init: function() {
                this.on("sending", function(file, xhr, formData) {
                });
            },
            
            params: {
                _token: token,
                type: 'gallery_image',
            },

            removedfile: function(file) {

                var fileName = file.name; 
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/gallery-images/removeUploadImages') }}",
                    data: {type:'gallery_image',name: fileName,request: 'delete'},
                    sucess: function(data){
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }

        });
        
    
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 3, // MB
            accept: function(file, done) {

            },
        };
        
    </script>
    
@endsection
