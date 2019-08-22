@extends('missing-persons::layouts.default')

@section('page_css')
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/jquery.fileuploader.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/thumbnails-theme.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.css" />
    
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/lc_switch.css') }}" />
@stop

@section('content')
    <div class="w-full md:max-w-2xl mx-auto flex bg-white border border-1 rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <form action="{{ route('persons.store') }}" method="POST" id="create-person-form" class="toggle-disabled">
            @method('POST')
            {{ csrf_field() }}
            
            <div class="-mx-3 md:flex mb-6">
		
                <div class="md:w-3/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">Име на лицето</label>
                    <input value="Георги Петков Колев" data-validation="length" data-validation-length="min5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" name="name" id="person-full-name" type="text" placeholder="Трите имена на лицето">
                    <p class="text-red text-xs italic">@lang('missing-persons::missing.please_fill_person_full_name')</p>
                </div>
			
                <div class="md:w-1/4 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">Възраст</label>
                    <input value="26" data-validation="number" data-validation-allowing="range[1;100]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" name="age" id="person-age" type="text" placeholder="">
                </div>
           </div>

          
           <div class="-mx-3 md:flex mb-2">
	  
              <div class="md:w-1/4 px-3">
                  <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">Пол</label>
                  <div class="relative">
                      <select name="sex" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
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
                      <select name="eyes_color" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
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
                      <select name="hair_color" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
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
                  <input value="174" data-validation="number" data-validation-allowing="range[1;250]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="person-height" name="height" type="text" placeholder="">
              </div>
              
            </div>
            
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">Описание</label>
                    <textarea class="w-full border p-4 border-1" placeholder="" name="description" rows="6">Тест тестов</textarea>
                </div>
            </div>
            
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-2/4 px-3">
                    <h2 class="block uppercase tracking-wide text-grey-darker text-md font-bold mb-2">Последно местоположение</h2>
                </div>
            </div>
            
            <div class="-mx-3 md:flex mb-2">
	            <div class="md:w-2/4 px-3">
                   <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-region">Област</label>
                   <div class="relative">
                       <select name="region_id" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-region">
                           @foreach ($regions as $region)
                               <option data-lat="{{ $region->lat }}" data-lng="{{ $region->lng }}" value="{{ $region->id }}" {{ ($person->region_id == $region->id ? "selected":"") }}>{{ $region->name }}</option>
                           @endforeach
                       </select>
                       <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                           <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                       </div>
                   </div>
               </div>
               
               <div class="md:w-2/4 px-3">
                  <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-settlement">Населено място</label>
                  <div class="relative">
                      <select name="settlement_id" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-settlement">
                          @foreach ($settlements as $settlement)
                              <option data-lat="{{ $settlement->lat }}" data-lng="{{ $settlement->lng }}" value="{{ $settlement->id }}" {{ ($person->settlement_id == $settlement->id ? "selected":"") }}>{{ $settlement->name }}</option>
                          @endforeach
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="-mx-3 md:flex mt-4 mb-3">
                <div class="md:w-full md:flex px-3 mb-6 md:mb-0">
                    <input type="checkbox" id="exact-address" name="exact_address" value="1" class="lcs_check" autocomplete="off" />
                    <label class="ml-3 leading-loose md:w-3/4 block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="exact-address">Искам да отбележа точното местоположение</label>
                </div>
            </div>
            
            <div id="map-wrapper" style="display:none;">
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-full px-3 mb-6 md:mb-0 flex">
                         <input placeholder="Въведете точен адрес" value="" class="flex-1 mr-2 appearance-none block w-full bg-grey-lighter text-grey-darker border border-red md:w-3/4 py-3 px-4" id="map-address" name="map_address" type="text">
                         <button type="button" id="button-search-address" class="appearance-none bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 md:w-1/4">Търсене</button>
                    </div>
                </div>
                
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <div id="map-box" class="md:w-full" style="height:180px;"></div>
                    </div>
                </div>
            </div>
            
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <input type="file" id="file" class="filename" name="filename[]" data-fileuploader-extensions="jpg, png">
                </div>
            </div>
            
            <input type="hidden" name="exact_address_text" value="{{ $person->last_place->address }}" id="exact-address-text">
            <input type="hidden" name="exact_address_latitude" value="{{ $person->last_place->lat }}" id="exact-address-latitude">
            <input type="hidden" name="exact_address_longitude" value="{{ $person->last_place->lng }}" id="exact-address-longitude">
            
            <input type="hidden" name="id" id="item-id" value="{{ $person->id }}" />
            <input type="hidden" name="hash" id="item-hash" value="{{ $person->hash }}" />
           
           <div class="-mx-3 md:flex mb-6">
               <div class="md:w-full px-3 mb-6 md:mb-0">
                   <button id="create-button" class="bg-indigo-800 leading-tight hover:bg-indigo-900 text-white font-bold py-4 px-6 w-full" type="submit">
                       @lang('missing-persons::missing.submit_person')
                   </button>
               </div>
           </div>
        </form>
    </div>

@endsection

@section('page_js')
    <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/jquery.fileuploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/lc_switch.min.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.js"></script>
    
    <script type="text/javascript" src="{{ asset('vendor/missing/js/pages/persons.create.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/missing/js/pages/persons.create.map.js') }}"></script>
@stop