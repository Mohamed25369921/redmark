@extends('layouts.admin')
<title>{{trans('home.faq')}}</title>
@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.faq')}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{trans('home.faq')}}</li>
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

    {!! Form::open(['route' => 'faqs.store', 'data-toggle'=>'validator', 'files'=>'true']) !!}
        <!-- Row-->
        <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card custom-card overflow-hidden">

                    <div class="card-body">
                        <div>
                            <h6 class="card-title mb-1">{{trans('home.faq')}}</h6>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field_wrapper">
                                    <div class="row">
                                        @if(count($questions) > 0)
                                            @foreach($questions as $key=>$question)
                                                <div class="form-group col-md-5"> 
                                                    <label for="question">{{trans('home.question')}}</label>
                                                    <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" readonly value="{{$question->question}}">
                                                </div>
        
                                                <div class="form-group col-md-5">
                                                    <label for="answer">{{trans('home.answer')}}</label>
                                                    <textarea class="form-control" placeholder="{{trans('home.answer')}}" readonly>{{$question->answer}}</textarea>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <button type="button" style="margin-top: 28px;" class="btn" data-toggle="modal" data-target="#iconForm_{{$key}}"><i class="fas fa-edit"></i></button>
                                                    <button type="button" style="margin-top: 28px;" class="btn rmv" data-faq_id="{{$question->id}}" id="type-error"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div>
                                            @endforeach    
                                        @else
                                            <div class="form-group col-md-6"> 
                                                <label for="question">{{trans('home.question')}}</label>
                                                <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question[]">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="answer">{{trans('home.answer')}}</label>
                                                <textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea>
                                            </div> 
                                        @endif
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
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="icon-note"></i> {{trans('home.save')}} </button>
                                <a href="{{url('/admin')}}"><button type="button" class="btn btn-danger mr-1"><i class="icon-trash"></i> {{trans('home.cancel')}}</button></a>
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
                            <div class="form-group col-md-6"> 
                                <label for="question">{{trans('home.question')}}</label>
                                <input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question" value="{{$question->question}}">
                            </div>

                            <div class="form-group col-md-6">
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

@endsection


@section('script')
    <script type="text/javascript">
        
        $(document).ready(function(){
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML ='<div class="row"><hr><div class="form-group col-md-5"><label for="question">{{trans('home.question')}}</label><input type="text"  class="form-control" placeholder="{{trans('home.question')}}" name="question[]"></div>';
            fieldHTML +='<div class="form-group col-md-5"><label for="answer">{{trans('home.answer')}}</label><textarea class="form-control" placeholder="{{trans('home.answer')}}" name="answer[]"></textarea></div>';
            fieldHTML +='<div class="form-group col-md-2"><a href="javascript:void(0);" style="margin-top: 30px;" class="remove_button btn"><i class="fas fa-trash-alt"></i></a></div></div>';

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