@extends('layouts.admin')
@section('meta')
    <title>{{trans('home.edit_attribute')}}</title>
@endsection
@section('content')

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.attributes')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/attributes')}}">{{trans('home.attributes')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.edit_attribute')}}</li>
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
    {!! Form::open(['method'=>'PATCH','url' => 'admin/attributes/'.$attribute->id, 'data-toggle'=>'validator', 'files'=>'true']) !!}
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
            	
                <div class="card custom-card overflow-hidden">
                    
                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.edit_attribute')}}</h6>
                            <hr>
                        </div>
                          
                        <div class="bg-light">
                            <nav class="nav nav-tabs">
                                <a class="nav-link active" data-toggle="tab" href="#tab1">{{trans('home.attribute')}}</a>
                                <a class="nav-link" data-toggle="tab" href="#tab2">{{trans('home.values')}}</a>
                            </nav>
                        </div>
                        
                        <div class="card-body tab-content">
                            <div class="tab-pane active show" id="tab1">
                                <div class="row">

                                    <div class="form-group col-md-5">
                                        <label class="">{{trans('home.name_en')}}</label>
                                        <input class="form-control" name="name_en" type="text" placeholder="{{trans('home.name_en')}}" value="{{$attribute->name_en}}" required>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label class="">{{trans('home.name_ar')}}</label>
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{trans('home.name_ar')}}"value="{{$attribute->name_ar}}" >
                                    </div>                                        

                                    <div class="col-md-2">
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

                                    @if($attribute->icon)
                                    <div class="col-md-12">
                                        <img src="{{url('uploads/attribute/source/'.$attribute->icon)}}" width="50">
                                    </div>
                                    @endif

                                    <div class="form-group col-md-12">
                                        <label for="category">{{trans('home.categories')}}</label>
                                        <select class="form-control select2" name="category_id[]" multiple>
                                            @foreach($categories as $categ)
                                                <option value="{{$categ->id}}" @foreach($categories_ids as $id)@if($categ->id == $id )selected @endif @endforeach>{{(app()->getLocale()=='en')? $categ->name_en:$categ->name_ar}}</option>
                                            @endforeach    
                                        </select>
                                        <br>
                                        <input type="checkbox" id="checkbox">  {{trans('home.selectall')}}
                                    </div>
                                    

                                    <div class="form-group col-md-12">
                                        <label class="ckbox">
                                            <input name="status" value="1" {{($attribute->status == 1)? 'checked':''}} type="checkbox"><span class="tx-13">{{trans('home.publish')}}</span>
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="tab2">
                                @foreach($values as $key=>$value)
                                    <div class="row">
                                        <div class="form-group col-md-5"> 
                                            <label for="value_en">{{trans('home.value_en')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.value_en')}}" value="{{$value->value_en}}" readonly>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="value_ar">{{trans('home.value_ar')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.value_ar')}}" value="{{$value->value_ar}}" readonly>
                                        </div> 

                                        <div class="form-group col-md-2">
                                            <button type="button" style="margin-top: 28px;" class="btn" data-toggle="modal" data-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                            <button type="button" style="margin-top: 28px;" class="btn rmv" data-value_id="{{$value->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>  
                                @endforeach 

                                <div class="field_wrapper">
                                    <div class="row">
                                        <div class="form-group col-md-6"> 
                                            <label for="value_en">{{trans('home.value_en')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en[]">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="value_ar">{{trans('home.value_ar')}}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('home.value_ar')}}" name="value_ar[]">
                                        </div> 
                                    </div>  
                                </div>       
                                <a href="javascript:void(0);" class="add_button btn" title="Add field"><i class="fas fa-plus-square"></i></a>
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
                        <div class="form-group col-md-12" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-success">{{trans('home.save')}} </button>
                            <a href="{{url('/admin/attributes')}}"><button type="button" class="btn btn-danger mr-1">{{trans('home.cancel')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        
    {!! Form::close() !!}

    <!-- Modal -->
    @foreach($values as $key=>$value)
        <div class="modal fade text-left" id="iconForm_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel34">{{trans('home.edit_attribute_value')}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('updateAttributeValue')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6"> 
                                    <label for="value_en">{{trans('home.value_en')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en" value="{{$value->value_en}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="value_ar">{{trans('home.value_ar')}}</label>
                                    <input type="text"  class="form-control" placeholder="{{trans('home.value_ar')}}" name="value_ar" value="{{$value->value_ar}}">
                                </div> 

                                <input type="hidden" name="value_id" value="{{$value->id}}"/>

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

@endsection

@section('script')
    <script>
        $("#checkbox").click(function(){
            if($("#checkbox").is(':checked') ){
                $(".select2 > option").prop("selected",true);
                $(".select2").trigger("change");
            }else{
                $('.select2 option:selected').prop("selected", false);
                $(".select2").trigger("change");
            }select2
        });


        $(document).ready(function(){
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML ='<div class="row"><hr><div class="form-group col-md-5"><label for="value_en">{{trans('home.value_en')}}</label><input type="text"  class="form-control" placeholder="{{trans('home.value_en')}}" name="value_en[]"></div>';
            fieldHTML +='<div class="form-group col-md-5"><label for="value_ar">{{trans('home.value_ar')}}</label><input type="text"  class="form-control" placeholder="{{trans('home.value_ar')}}" name="value_ar[]"></div>';
            fieldHTML +='<div class="form-group col-md-2"><a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn"><i class="fas fa-trash-alt"></i></a></div></div>';

            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
                $('.status').select2({
                    'placeholder' : 'Status',
                });
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
                var value_id = $(this).data('value_id');
                console.log(value_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{route('removeAttributeValue',app()->getLocale())}}",
                    method:'POST',
                    data: {value_id:value_id},
                    success:function(data) {
                        location.reload();
                    }
                });
            });
            
        });
  
    </script>
@endsection

