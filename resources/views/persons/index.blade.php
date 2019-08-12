@extends('missing-persons::layouts.default')

@section('page_css')
@stop

@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap overflow-hidden xl:-mx-2">
        @forelse ($persons as $num => $person)
            <div class="w-full overflow-hidden xl:my-2 xl:px-2 xl:w-1/5">
                <div class="max-w-sm overflow-hidden">
                    <a href="persons/view/{{ $person->hash }}">
                        @if ($person->thumb)
                            <img src="{{ url('storage/' . $person->thumb) }}" alt="{{ $person->name }}" class="w-full" />
                        @else
                            <img src="no-photo.png" alt="{{ $person->name }}" class="w-full" />
                        @endif
                    </a>
                    <div class="py-3 px-3 border-gray-400 border">
                        <div class="font-bold text-base mb-2">{{ $person->name }}</div>
                        <p class="text-sm text-gray-600 flex items-center">
                            @if ($person['last_place'])
                                {{ $person['last_place']->address }}
                            @endif
                            @if ($person['region'])
                            {{ $person['region']->name }}
                            @endif
                            @if ($person['settlement'])
                                {{ $person['settlement']->name }}
                            @else
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