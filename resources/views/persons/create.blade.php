@extends('missing-persons::layouts.default')
@section('page_css')
@stop
@section('content')
    <div class="w-full md:max-w-2xl mx-auto flex bg-white border border-1 rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        
        <div class="-mx-3 md:flex mb-6">		
            <div class="md:w-3/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">Име на лицето</label>
                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" name="name" id="person-full-name" type="text" placeholder="Трите имена на лицето">
                <p class="text-red text-xs italic">@lang('missing.please_fill_person_full_name')</p>
            </div>			
            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">Възраст</label>
                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" placeholder="">
            </div>
       </div>
      
       <div class="-mx-3 md:flex mb-2">	  
          <div class="md:w-1/4 px-3">
              <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">Пол</label>
              <div class="relative">
                  <select class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                      @foreach ($genders as $gender)
                          <option value="{{ $gender['id'] }}">{{ $gender['text'] }}</option>
                      @endforeach
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
              </div>
          </div>
          
          <div class="md:w-1/4 px-3">
              <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">Цвят на очите</label>
              <div class="relative">
                  <select class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                      @foreach ($eyes_colors as $eye_color)
                          <option value="{{ $eye_color->id }}">{{ $eye_color->name }}</option>
                      @endforeach
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
              </div>
          </div>

          <div class="md:w-1/4 px-3">
              <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">Цвят на косата</label>
              <div class="relative">
                  <select class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                      @foreach ($hair_colors as $hair_color)
                          <option value="{{ $hair_color->id }}">{{ $hair_color->name }}</option>
                      @endforeach
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
              </div>
          </div>
          
          <div class="md:w-1/4 px-3">
              <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">Ръст</label>
              <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" placeholder="">
          </div>
          
        </div>
        
        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">Описание</label>
                <textarea class="w-full border p-4 border-1" placeholder="" rows="6"></textarea>
            </div>
       </div>

        
    </div>
@endsection
@section('page_js')
    <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/persons.create.js') }}"></script>
@stop