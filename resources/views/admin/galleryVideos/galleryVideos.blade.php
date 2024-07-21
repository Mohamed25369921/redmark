@extends('layouts.admin')
<title>{{trans('home.galleryVideos')}}</title>
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">{{trans('home.galleryVideos')}}</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{trans('home.galleryVideos')}}</li>
                </ol>
            </div>
            <div class="btn btn-list">
                <a href="{{url('admin/gallery-videos/create')}}"><button class="btn ripple btn-primary"><i class="fas fa-plus-circle"></i> {{trans('home.add')}}</button></a>
                <a id="btn_active"><button class="btn ripple btn-dark"><i class="fas fa-eye"></i> {{trans('home.publish/unpublish')}}</button></a>
                <a id="btn_delete" ><button class="btn ripple btn-danger"><i class="fas fa-trash"></i> {{trans('home.delete')}}</button></a>
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
			<div class="col-lg-12 col-md-12">
				<div class="card custom-card">
					<div class="card-body">
						<div>
							<h6 class="card-title mb-1">{{trans('home.galleryVideos')}}</h6>
							<p class="text-muted card-sub-title">{{trans('home.list of all available gallery videos')}}</p>
						</div>

						<div class="table-responsive">
                            <table class="table" id="exportexample1">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"/></th>
                                        <th>{{trans('home.id')}}</th>
                                        <th>{{trans('home.video')}}</th>
                                        <th>{{trans('home.order')}}</th>
                                        <th>{{trans('home.status')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="sortable">
                                    @foreach($galleryVideos as $galleryVideo)
                                        <tr id="{{$galleryVideo->id}}" data-id="{{ $galleryVideo->id }}"  class="image">
                                            <td> <input type="checkbox" name="checkbox"  class="tableChecked" value="{{$galleryVideo->id}}" /> </td>
                                            <td><a href="{{ route('gallery-videos.edit', $galleryVideo->id) }}">{{$galleryVideo->id}}</a></td>
                                            <td>
                                                <a href="{{ route('gallery-videos.edit', $galleryVideo->id) }}">
                                                    <iframe width="200" height="150"
                                                        src="{{$galleryVideo->youtube_link}}">
                                                    </iframe>
                                                </a>
                                            </td>
                                            <td class="order">{{$galleryVideo->order}}</td>
                                            <td><a href="{{ route('gallery-videos.edit', $galleryVideo->id) }}">@if($galleryVideo->status == 1) {{trans('home.yes')}} @else  {{trans('home.no')}} @endif</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
    					</div>
					</div>
				</div>
			</div>
		</div>
        <!-- End Row -->
    </div>
@endsection
@section('script')
    <script>
        /////// make table row sortable ////
        $(document).ready(function () {
            var $videos = $('.sortable');
            $videos.sortable({
                connectWith: '.sortable',
                items: 'tr.image',
                stop: (event, ui) => {
                    sendReordervideosRequest($(ui.item).parent());
    
                    if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                        if ($(event.target).find('tr.image').length) {
                            sendReordervideosRequest($(event.target));
                        } else {
                            $(event.target).find('.empty-message').show();
                        }
                    }
                }
            });
            $('table, .sortable').disableSelection();
        });
        
        ////// send reorder request //////////////
        function sendReordervideosRequest($image) {
            var items = $image.sortable('toArray', {attribute: 'data-id'});
            var ids = $.grep(items, (item) => item !== "");
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            if ($image.find('tr.image').length) {
                $image.find('.empty-message').hide();
            }

            $.post('{{ url('admin/gallery-videos/reorder') }}', {
                _token,
                ids,
            })
            .done(function (response) {
                $image.children('tr.image').each(function (index, image) {
                    $(image).children('.order').text(response.positions[$(image).data('id')])
                });
            })
            .fail(function (response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
        }

    </script>
@endsection    
