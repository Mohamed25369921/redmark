@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_service')}}</title>
@endsection

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
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.services')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/services')}}">{{trans('home.services')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_service')}}</li>
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
                            <h6 class="card-title ">{{trans('home.edit_service')}}</h6>
                        </div>
                        {!! Form::open(['method'=>'PATCH','url' => 'admin/services/'.$service->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="name_en">{{trans('home.name_en')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name_en')}}" name="name_en" value="{{$service->name_en}}" required>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="name_ar">{{trans('home.name_ar')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name_ar')}}" name="name_ar" value="{{$service->name_ar}}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link" value="{{$service->youtube_link}}">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="helperText">{{trans('home.parent')}}</label>
                                    <select class="form-control select2" name="parent_id" required>
                                        <option value="0" {{($service->parent_id == 0)?'selected':''}}>{{trans('home.no_parent')}}</option>
                                        @foreach($services as $serv)
                                            <option value="{{$serv->id}}"  {{($serv->id ==$service->parent_id)?'selected':''}}>{{(app()->getLocale() == 'en')?$serv->name_en:$serv->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-1">
                                    <label for="order">{{trans('home.order')}}</label>
                                    <input type="number" min="0"  class="form-control" placeholder="{{trans('home.order')}}" name="order" value="{{$service->order}}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label>{{trans('home.image')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_image')}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-2">
                                    <label for="alt_img"> {{trans('home.alt_img')}}</label>
                                    <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}" value="{{$service->alt_img}}">
                                </div>

                                <div class="col-md-6">
                                    <label>{{trans('home.icon')}}</label>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> {{trans('home.upload')}}</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="icon">
                                            <label class="custom-file-label" for="inputGroupFile01">{{trans('home.choose_icon')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        @if($service->img)
                                            <div class="col-md-6">
                                                <img src="{{url('\uploads\services\resize200')}}\{{$service->img}}" width="200" height="150">
                                            </div>
                                        @endif

                                        @if($service->icon)
                                            <div class="col-md-6">
                                                <img src="{{url('\uploads\services\resize200')}}\{{$service->icon}}" width="200" height="150">
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="text_en">{{trans('home.text_en')}}</label>
                                    <textarea class="form-control area1" name="text_en" placeholder="{{trans('home.text_en')}}" >{!! $service->text_en !!}</textarea>
                                </div>

                                <div class="form-group col-md-6 "> 
                                    <label for="text_ar">{{trans('home.text_ar')}}</label>
                                    <textarea class="form-control area1" name="text_ar" placeholder="{{trans('home.text_ar')}}" >{!! $service->text_ar !!}</textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="status" value="1" {{($service->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                    </label>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="home" value="1" {{($service->home == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.home')}}</span>
                                    </label>
                                </div>


                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="menu" value="1" {{($service->menu == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.menu')}}</span>
                                    </label>
                                </div>


                                <div class="form-group col-md-12">
                                    <hr>
                                    <label for="images">{{trans('home.service_images')}}</label>
                                        <div class="dropzone col-md-12 upload_images">
                                    </div>
                                </div>
                                
                                @if($service->images())
                                    <div class="col-md-12">
                                        <div id="lightgallery" class="row mb-0">
                                            @foreach($service->images() as $key=>$image)
                                                <div class="col-xs-6 col-sm-2 col-md-2 col-xl-2 mb-2 pl-sm-2 pr-sm-2" data-responsive="{{url('uploads/services/source/'.$image->image)}}" data-src="{{url('uploads/services/source/'.$image->image)}}" data-sub-html="<h4> {{trans('home.image')}} {{$key+1}}</h4>">
                                                    <a href="">
                                                        <img class="img-responsive" src="{{url('uploads/services/source/'.$image->image)}}">
                                                    </a>
                                                    <div>
                                                        <a href='#' data-image='{{$image->id}}' class='delete_img_btn' >{{trans('home.delete')}}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.en')}}</span>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label for="link_en">{{trans('home.slug')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$service->link_en}}">
                                        </div>
                                
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}">{{$service->meta_title_en}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}">{{$service->meta_desc_en}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label for="link_ar">{{trans('home.slug')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar" value="{{$service->link_ar}}">
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$service->meta_title_ar}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$service->meta_desc_ar}}</textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="ckbox">
                                                <input name="meta_robots" value="1" {{($service->meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    
                                    <div class="field_wrapper">
                                        <h5>{{trans('home.faq')}}</h5>
                                        <div class="row">
                                            @if(count($questions) > 0)
                                                @foreach($questions as $key=>$question)
                                                    <div class="form-group col-md-12"> 
                                                        <label for="question">{{trans('home.question')}}</label>
                                                        <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" readonly value="{{$question->question}}">
                                                    </div>
            
                                                    <div class="form-group col-md-10">
                                                        <label for="answer">{{trans('home.answer')}}</label>
                                                        <textarea class="form-control" placeholder="{{trans('home.answer')}}" readonly>{{$question->answer}}</textarea>
                                                    </div>
    
                                                    <div class="form-group col-md-2">
                                                        <button type="button" style="margin-top: 28px;" class="btn" data-toggle="modal" data-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                                        <button type="button" style="margin-top: 28px;" class="btn rmv" data-faq_id="{{$question->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                                    </div>
                                                @endforeach    
                                            @else
                                                <div class="form-group col-md-12"> 
                                                    <label for="question">{{trans('home.question')}}</label>
                                                    <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question[]">
                                                </div>
        
                                                <div class="form-group col-md-12">
                                                    <label for="answer">{{trans('home.answer')}}</label>
                                                    <textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea>
                                                </div> 
                                            @endif
                                        </div>  
                                    </div>       
                                    <a href="javascript:void(0);" class="add_button btn" title="Add field"><i class="fas fa-plus-square"></i></a>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success"><i class="image-note"></i> {{trans('home.save')}} </button>
                                    <a href="{{url('/admin/services')}}"><button type="button" class="btn btn-danger mr-1"><i class="image-trash"></i> {{trans('home.cancel')}}</button></a>
                                </div>
                                
                            </div>
                        {!! Form::close() !!}
                        
                         <!-- Modal -->
                        @foreach($questions as $key=>$question)
                            <div class="modal fade text-left" id="iconForm_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="myModalLabel34">{{trans('home.edit_faq')}}</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('updateFaq')}}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12"> 
                                                        <label for="question">{{trans('home.question')}}</label>
                                                        <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question" value="{{$question->question}}">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label for="answer">{{trans('home.answer')}}</label>
                                                        <textarea type="text"  class="form-control" placeholder="{{trans('home.answer')}}" name="answer" >{{$question->answer}}</textarea>
                                                    </div> 

                                                    <input type="hidden" name="faq_id" value="{{$question->id}}"/>

                                                    <div class="form-group col-md-12">
                                                        <button type="submit" class="btn btn-success">{{trans('home.save')}} </button>
                                                    </div>
                                                </div>                             
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            url: "{{ URL::to('admin/services/uploadImages') }}",

            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("serviceId", {{$service->id}});
                });
            },
            
            params: {
                _token: token,
                type: 'product_image',
            },

            removedfile: function(file) {

                var fileName = file.name; 
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/services/removeUploadImages') }}",
                    data: {type:'service_image',name: fileName,request: 'delete'},
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
        
        $('.delete_img_btn').on('click',function(){
            var image = $(this).data('image');
            var serviceId={{$service->id}};
            var btn = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:" {{url('admin/services/deleteImege')}}",
                method:'POST',
                data:{image:image , serviceId:serviceId },
                success:function(data)
                {
                    location.href = "{{route('services.edit',$service->id)}}";
                }
            });
        });
        
        
        $(document).ready(function(){
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML ='<div class="row"><hr><div class="form-group col-md-12"><label for="question">{{trans('home.question')}}</label><input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question[]"></div>';
            fieldHTML +='<div class="form-group col-md-11"><label for="answer">{{trans('home.answer')}}</label><textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea></div>';
            fieldHTML +='<div class="form-group col-md-1"><a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn"><i class="fas fa-trash-alt"></i></a></div></div>';

            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
        
        $(document).ready(function(){
            $('.rmv').click(function () {
                var faq_id = $(this).data('faq_id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{route('removeFaq')}}",
                    method:'POST',
                    data: {faq_id:faq_id},
                    success:function(data) {
                        location.reload();
                    }
                });
            });
            
        });

    </script>
    
@endsection