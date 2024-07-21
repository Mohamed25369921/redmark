@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_project')}}</title>
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
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.projects')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/projects')}}">{{trans('home.projects')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_project')}}</li>
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

    {!! Form::open(['method'=>'PATCH','url' => 'admin/projects/'.$project->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
            
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.edit_project')}}</h6>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_en')}}</label>
                                <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" value="{{$project->name_en}}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.name_ar')}}</label>
                                <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}"value="{{$project->name_ar}}" >
                            </div>

                            <div class="form-group col-md-1">
                                <label class="">{{trans('home.price')}}</label>
                                <input class="form-control" name="price" type="number" min="0" placeholder="{{trans('home.price')}}"value="{{$project->price}}" >
                            </div>

                            <div class="col-md-3">
                                <label>{{trans('home.main_image')}}</label>
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

                            <div class="form-group col-md-2">
                                <label for="alt_img"> {{trans('home.alt_img')}}</label>
                                <input class="form-control" name="img_alt" type="text" placeholder="{{trans('home.alt_img')}}" value="{{$project->alt_img}}">
                            </div>

                            @if($project->image)
                                <div class="col-md-12">
                                    <img src="{{url('\uploads\projects\resize200')}}\{{$project->image}}" width="150">
                                    <br>
                                </div>
                            @endif

                            <div class="form-group col-md-6">
                                <label for="text_en"> {{trans('home.text_en')}}</label>
                                <textarea class="form-control area1" name="text_en" placeholder="{{trans('home.text_en')}}">{{$project->text_en}}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="text_ar"> {{trans('home.text_ar')}}</label>
                                <textarea class="form-control area1" name="text_ar" placeholder="{{trans('home.text_ar')}}">{{$project->text_ar}}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <hr>
                                <label for="images">{{trans('home.project_images')}}</label>
                                    <div class="dropzone col-md-12 upload_images">
                                </div>
                            </div>

                            @if($project->images())
                                <div class="col-md-12">
                                    <div id="" class="row mb-0">
                                        @foreach($project->images() as $key=>$image)
                                            <div class="col-xs-6 col-sm-2 col-md-2 col-xl-2 mb-2 pl-sm-2 pr-sm-2" data-responsive="{{url('uploads/projects/source/'.$image->image)}}" data-src="{{url('uploads/projects/source/'.$image->image)}}" data-sub-html="<h4> {{trans('home.image')}} {{$key+1}}</h4>">
                                                <a href="javascript:;">
                                                    <img class="img-responsive" src="{{url('uploads/projects/source/'.$image->image)}}" width="150px" height="150px">
                                                </a>
                                                <div>
                                                    <br>
                                                    <a href='#' data-image='{{$image->id}}' class='delete_img_btn btn btn-danger' >{{trans('home.delete')}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <br>
                                <hr>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="ckbox">
                                    <input name="status" value="1" {{($project->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                </label>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="ckbox">
                                    <input name="status" value="1" {{($project->recommended == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.recommended')}}</span>
                                </label>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.edit_category')}}  <span class="badge badge-warning">{{trans('home.changing category will change specifications values')}}</span></h6>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-12">
                                <button type="button" class="btn" style="position: absolute; top: -70px; right: -35px;" data-toggle="modal" data-target="#Modal1"><i class="fas fa-edit" color="black"></i></button>
                                    <select class="form-control select2" disabled >
                                        <option value="{{$project->category_id}}">{{(app()->getLocale()=='en')? $project->category->name_en:$project->category->name_ar}}</option>
                                    </select>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->


        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="row">    
                            <div class="col-md-12">
                                <h6 class="card-title mb-1">{{trans('home.Course Features')}}</h6>
                                <hr>
                            </div>                           
                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Instructor_en')}}</label>
                                <input class="form-control" name="instructor_en" type="text" placeholder="{{trans('home.Instructor_en')}}"  value="{{$project->instructor_en}}" >
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Instructor_ar')}}</label>
                                <input class="form-control" name="instructor_ar" type="text" placeholder="{{trans('home.Instructor_ar')}}" value="{{$project->instructor_ar}}" >
                            </div>
                  

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Lectures')}}</label>
                                <input class="form-control" name="lectures" type="number" min="0" placeholder="{{trans('home.Lectures')}}" value="{{$project->lectures}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Duration')}}</label>
                                <input class="form-control" name="duration" type="number" min="0" placeholder="{{trans('home.Duration')}}" value="{{$project->duration}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Enrolled')}}</label>
                                <input class="form-control" name="enrolled" type="number" min="0" placeholder="{{trans('home.Enrolled')}}" value="{{$project->enrolled}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Language_en')}}</label>
                                <input class="form-control" name="language_en" type="text" min="0" placeholder="{{trans('home.Language_en')}}" value="{{$project->language_en}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="">{{trans('home.Language_ar')}}</label>
                                <input class="form-control" name="language_ar" type="text" min="0" placeholder="{{trans('home.Language_ar')}}" value="{{$project->language_ar}}">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h6 class="card-title mb-1">{{trans('home.seo_block')}}</h6>
                            <hr>
                            <span class="badge badge-success">{{trans('home.en')}}</span>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label for="link_en">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en" value="{{$project->link_en}}">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                            <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}">{{$project->meta_title_en}}</textarea>
                        </div>
                        
                        <div class="form-group col-md-5">
                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                            <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}">{{$project->meta_desc_en}}</textarea>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <hr>
                            <span class="badge badge-success">{{trans('home.ar')}}</span>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label for="link_ar">{{trans('home.slug')}}</label>
                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar" value="{{$project->link_ar}}">
                        </div>
                        
                        <div class="form-group col-md-5">
                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                            <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}">{{$project->meta_title_ar}}</textarea>
                        </div>
                        
                        <div class="form-group col-md-5">
                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}">{{$project->meta_desc_ar}}</textarea>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label class="ckbox">
                                <input name="meta_robots" value="1" {{($project->meta_robots == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
            
        <h5>{{trans('home.faq description')}}</h5>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="text_en"> {{trans('home.faq_en')}}</label>
                <textarea class="form-control area1" name="faq_en" placeholder="{{trans('home.text_en')}}">{{$project->faq_en}}</textarea>
            </div>

            <div class="form-group col-md-6">
                <label for="text_ar"> {{trans('home.faq_ar')}}</label>
                <textarea class="form-control area1" name="faq_ar" placeholder="{{trans('home.text_ar')}}">{{$project->faq_ar}}</textarea>
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
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="row">    
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                <a href="{{url('/admin/projects')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

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
    <!-- modal1 -->
    <div class="modal fade text-left" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel34">{{trans('home.edit_category')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admin/projects/changeCategory/'.$project->id)}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="form-group col-md-12">
                                <select class="form-control select2" name="category_id" id="category" required>
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{(app()->getLocale()=='en')? $category->name_en:$category->name_ar}}</option>
                                    @endforeach 
                                </select>
                            </div>  

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"> {{trans('home.save')}} </button>
                            </div>
                        </div>                             
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            url: "{{ URL::to('admin/projects/uploadImages') }}",

            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("projectId", {{$project->id}});
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
                    url: "{{ URL::to('admin/projects/removeUploadImages') }}",
                    data: {type:'project_image',name: fileName,request: 'delete'},
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
            var projectId={{$project->id}};
            var btn = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:" {{url('admin/projects/deleteImege')}}",
                method:'POST',
                data:{image:image , projectId:projectId },
                success:function(data)
                {
                    location.href = "{{route('projects.edit',$project->id)}}";
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

