@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.add_service')}}</title>
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
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.add_service')}}</li>
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
                            <h6 class="card-title ">{{trans('home.add_service')}}</h6>
                        </div>
                        {!! Form::open(['route' => 'services.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="name_en">{{trans('home.name_en')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name_en')}}" name="name_en" required>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="name_ar">{{trans('home.name_ar')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.name_ar')}}" name="name_ar">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="youtube_link">{{trans('home.youtube_link')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.youtube_link')}}" name="youtube_link">
                                </div>
                                
                                
                                <div class="form-group col-md-3">
                                    <label for="helperText">{{trans('home.parent')}}</label>
                                    <select class="form-control select2" name="parent_id" required>
                                        <option value="0">{{trans('home.no_parent')}}</option>
                                        @foreach($services as $serv)
                                            <option value="{{$serv->id}}">{{(app()->getLocale() == 'en')?$serv->name_en:$serv->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                 <div class="form-group col-md-1">
                                    <label for="order">{{trans('home.order')}}</label>
                                    <input type="number" min="0"  class="form-control" placeholder="{{trans('home.order')}}" name="order">
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
                                    <input class="form-control" name="alt_img" type="text" placeholder="{{trans('home.alt_img')}}">
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

                                <div class="form-group col-md-6 ">
                                    <label for="text_en">{{trans('home.text_en')}}</label>
                                    <textarea class="form-control area1" name="text_en" placeholder="{{trans('home.text_en')}}" ></textarea>
                                </div>

                                <div class="form-group col-md-6 "> 
                                    <label for="text_ar">{{trans('home.text_ar')}}</label>
                                    <textarea class="form-control area1" name="text_ar" placeholder="{{trans('home.text_ar')}}" ></textarea>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="status" value="1" type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                    </label>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="home" value="1" type="checkbox"><span class="tx-13">{{trans('home.home')}}</span>
                                    </label>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label class="ckbox">
                                        <input name="menu" value="1" type="checkbox"><span class="tx-13">{{trans('home.menu')}}</span>
                                    </label>
                                </div>
                                
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.en')}}</span>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label for="link_en">{{trans('home.slug')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_en">
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_en" placeholder="{{trans('home.meta_title')}}"></textarea>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_en" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <hr>
                                            <span class="badge badge-success">{{trans('home.ar')}}</span>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="link_ar">{{trans('home.slug')}}</label>
                                            <input type="text" class="form-control" placeholder="{{trans('home.slug')}}" name="link_ar">
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_title"> {{trans('home.meta_title')}}</label>
                                            <textarea class="form-control" name="meta_title_ar" placeholder="{{trans('home.meta_title')}}"></textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            <label for="meta_desc"> {{trans('home.meta_desc')}}</label>
                                            <textarea class="form-control" name="meta_desc_ar" placeholder="{{trans('home.meta_desc')}}"></textarea>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="ckbox">
                                                <input name="meta_robots" value="1" type="checkbox"><span class="tx-13">{{trans('home.meta_robots')}} (index)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <hr>
                                    
                                    <div class="field_wrapper">
                                        <h5>{{trans('home.faq')}}</h5>
                                        <div class="row">
                                            <div class="form-group col-md-5"> 
                                                <label for="question">{{trans('home.question_en')}}</label>
                                                <input type="text"  class="form-control" placeholder="{{trans('home.question_en')}}" name="question_en[]">
                                            </div>
    
                                            <div class="form-group col-md-5">
                                                <label for="answer">{{trans('home.answer_en')}}</label>
                                                <textarea class="form-control" placeholder="{{trans('home.answer_en')}}" name="answer_en[]"></textarea>
                                            </div> 
                                            
                                            <div class="form-group col-md-3">
                                                <label class="ckbox">
                                                    <input name="faq_status" value="1" type="checkbox"><span class="tx-13">{{trans('home.status')}}</span>
                                                </label>
                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

@endsection

@section('script')
    <script>
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
    </script>
@endsection
