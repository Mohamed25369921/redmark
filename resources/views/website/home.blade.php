@extends('layouts.app')
@section('meta')
    @php echo $metatags @endphp

    @php echo $schema @endphp
@endsection

@section('content')
    @include('website.home-partials.slider')

    @include('website.home-partials.about-us')

    @include('website.home-partials.services')

    @include('website.home-partials.projects')

    @include('website.home-partials.marque')

    @include('website.home-partials.contact_form')

    @include('website.home-partials.blogs')

    @include('website.home-partials.clients')
    {{-- @include('website.home-partials.maps') --}}


{{-- @include('website.home-partials.steps') --}}


{{-- @include('website.home-partials.video') --}}

@endsection

@section('script')
    @if (Session::has('contact_message'))
        <script>
            $.alert({
                title: "{{ trans('home.contact_us') }}",
                content: "{{ Session::get('contact_message') }}",
                buttons: {
                    ok: {
                        text: "{{ trans('home.OK') }}",
                        btnClass: 'btn main-btn',
                    },
                },
                columnClass: 'col-md-6'
            });
        </script>
    @endif
    @php
        Session::forget('contact_message');
    @endphp
@endsection
