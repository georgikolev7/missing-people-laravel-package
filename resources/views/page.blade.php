@extends('missing-persons::layouts.default')

@section('page_css')
@stop

@section('breadcrumbs')
    {{ Breadcrumbs::render('map') }}
@stop
@section('content')
    <div class="container mx-auto px-6 md:px-0">
        <div class="w-full flex items-center justify-center my-auto">
            <div class="w-full sm:w-1/2 md:w-4/5 markdown">{!! $page->content !!}</div>
        </div>
    </div>
@endsection