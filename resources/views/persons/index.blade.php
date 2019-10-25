@extends('missing-persons::layouts.default')
@section('title', __('missing-persons::missing.missing_persons'))
@section('description', __('missing-persons::missing.default_meta_description'))
@section('keywords', __('missing-persons::missing.default_meta_keywords'))
@section('page_css')
@stop
@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@stop
@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap overflow-hidden xl:-mx-2">
        @forelse ($persons as $num => $person)
            <div class="my-1 px-1 w-1/2 overflow-hidden xl:my-2 xl:px-2 xl:w-1/5">
                <div class="max-w-sm overflow-hidden">
                    <a href="persons/view/{{ $person->hash }}">
                        @if ($person->thumb)
                            <img src="{{ url('storage/' . $person->thumb) }}" alt="{{ $person->name }}" class="w-full p-photo" />
                        @else
                            <img src="no-photo.png" alt="{{ $person->name }}" class="w-full" />
                        @endif
                    </a>					
                    <div class="py-3 px-3 text-center">
                        <div class="font-bold text-base mb-2 uppercase">{{ $person->name }}</div>
                        <p class="text-sm text-gray-600 text-center">
                            @if ($person['last_place'])
                                {{ $person['last_place']->address }}
                            @endif
                            @if ($person['region'])
								{{ $person['region']->name }}
                            @endif
                            @if ($person['settlement'])
                                {{ $person['settlement']->name }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @empty
            Няма публикувани
        @endforelse
        </div>
    </div>
@endsection
@section('page_js')
@stop