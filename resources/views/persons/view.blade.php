@extends('missing-persons::layouts.default')

@section('title', $person->name)
@section('description', $person->description)
@section('keywords', $person->description)

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
                <ul class="list-none sm:list-disc md:list-decimal lg:list-disc xl:list-none">
                    <li><strong>@lang('missing-persons::missing.person_name'):</strong> {{ $person->name }}</li>
                    <li><strong>@lang('missing-persons::missing.age'):</strong> {{ $person->age }} г.</li>
                    <li><strong>@lang('missing-persons::missing.height'):</strong> {{ $person->height }} см</li>
                    <li><strong>@lang('missing-persons::missing.gender'):</strong> {{ $person->sex }}</li>
                    <li><strong>@lang('missing-persons::missing.year_of_birth'):</strong> {{ $person->year_of_birth }} г.</li>
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
@stop