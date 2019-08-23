@extends('missing-persons::layouts.default')

@section('page_css')
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
@stop

@section('content')
    <div class="container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap overflow-hidden xl:-mx-2">
            <div class="w-full overflow-hidden xl:my-1 xl:px-1 xl:w-1/2">
                <div class="fotorama" data-width="100%" data-height="450" data-nav="thumbs" data-fit="cover" data-allowfullscreen="true">
                    @foreach ($person->photos as $photo)
                        <a href="{{ url('storage/' . $photo->file) }}"><img src="{{ url('storage/' . $photo->thumb) }}"></a>
                    @endforeach
                </div>
            </div>

            <div class="w-full overflow-hidden xl:my-1 xl:px-1 xl:w-1/2">
                @auth
                    <a href="{{ url('persons/edit/' . $person->hash) }}">@lang('missing-persons::missing.edit')</a>
                    <a href="{{ url('persons/delete/' . $person->hash) }}">@lang('missing-persons::missing.delete')</a>
                    <button id="set-as-found" data-href="{{ url('persons/set_found/' . $person->hash) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">@lang('missing-persons::missing.set_found')</button>
                @endauth
                
                <ul class="list-none sm:list-disc md:list-decimal lg:list-disc xl:list-none">
                    <li><strong>@lang('missing-persons::missing.person_name'):</strong> {{ $person->name }}</li>
                    <li><strong>@lang('missing-persons::missing.age'):</strong> {{ $person->age }} @lang('missing-persons::missing.year_short')</li>
                    <li><strong>@lang('missing-persons::missing.height'):</strong> {{ $person->height }} @lang('missing-persons::missing.cm')</li>
                    <li><strong>@lang('missing-persons::missing.gender'):</strong> {{ $person->sex }}</li>
                    <li><strong>@lang('missing-persons::missing.year_of_birth'):</strong> {{ $person->year_of_birth }} @lang('missing-persons::missing.year_short')</li>
                    <li><strong>@lang('missing-persons::missing.last_seen_on'):</strong> {{ $person->last_seen }}</li>
                </ul>
                
                <div class="person-content">
                    <h6>@lang('missing-persons::missing.description'):</h6>
                    <div class="">{{ $person->description }}</div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/pages/persons.view.js') }}"></script>
@stop