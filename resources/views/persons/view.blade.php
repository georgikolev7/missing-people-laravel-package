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
                <ul class="list-none sm:list-disc md:list-decimal lg:list-disc xl:list-none">
                    <li><strong>Име на лицето:</strong> {{ $person->name }}</li>
                    <li><strong>Възраст:</strong> {{ $person->age }} г.</li>
                    <li><strong>Ръст:</strong> {{ $person->height }} см</li>
                    <li><strong>Пол:</strong> {{ $person->sex }}</li>
                    <li><strong>Година на раждане:</strong> {{ $person->year_of_birth }} г.</li>
                    <li><strong>Последно забелязан/а:</strong> {{ $person->last_seen }}</li>
                </ul>
                
                <div class="person-content">
                    <h6>ОПИСАНИЕ:</h6>
                    <div class="">{{ $person->description }}</div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@stop