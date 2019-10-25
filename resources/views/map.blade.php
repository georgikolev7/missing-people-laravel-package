@extends('missing-persons::layouts.default')
@section('page_css')
    <link href="{{ asset('vendor/missing/js/leafletjs/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/missing/js/leafletjs/leaflet.markercluster/markercluster.default.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/missing/js/leafletjs/leaflet.markercluster/markercluster.css') }}" rel="stylesheet">
@stop
@section('breadcrumbs')
    {{ Breadcrumbs::render('map') }}
@stop
@section('content')
    <div class="w-screen mx-auto h-screen">
        <div class="flex flex-wrap overflow-hidden xl:-mx-2">
            <div id="map-box" class="w-full h-screen"></div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        window.locations = @json($locations);
    </script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/leafletjs/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/leafletjs/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/pages/map.page.js') }}"></script>
@stop