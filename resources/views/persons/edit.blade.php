@extends('missing-persons::layouts.default')

@section('robots', 'noindex, nofollow')

@section('page_css')
	<link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/jquery.fileuploader.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/thumbnails-theme.css') }}" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.css" />
	<link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/css/lc_switch.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('vendor/missing/js/air-datepicker/css/datepicker.min.css') }}" />
@stop

@section('content')
<div class="w-full md:max-w-2xl mx-auto flex bg-white border border-1 rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    <form action="{{ route('persons.update', $person->hash) }}" method="POST" id="edit-person-form" class="toggle-disabled">
        @method('PUT')
        {{ csrf_field() }}
        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-3/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">@lang('missing-persons::missing.person_name')</label>
                <input value="{{ $person->name }}" data-validation="length" data-validation-length="min5" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" name="name" id="person-full-name" type="text" placeholder="Трите имена на лицето">
                <p class="text-red text-xs italic">
					@lang('missing-persons::missing.please_fill_person_full_name')
				</p>
            </div>

            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">@lang('missing-persons::missing.year_of_birth')</label>
                <input value="{{ $person->profile->year_of_birth }}" data-validation="number" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" name="year_of_birth" id="person-year-of-birth" type="text" placeholder="">
            </div>
        </div>

        <div class="-mx-3 md:flex mb-2">
            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">@lang('missing-persons::missing.gender')</label>
                <div class="relative">
                    <select name="sex" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                        @foreach ($genders as $gender)
                        <option value="{{ $gender['id'] }}" {{ ($person->profile->sex == $gender['id'] ? "selected":"") }}>{{ $gender['text'] }}</option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>

            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">@lang('missing-persons::missing.eyes_color')</label>
                <div class="relative">
                    <select name="eyes_color" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                        @foreach ($eyes_colors as $eye_color)
                        <option value="{{ $eye_color->id }}" {{ ($person->profile->eyes_color == $eye_color->id ? "selected":"") }}>{{ $eye_color->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>

            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">@lang('missing-persons::missing.hair_color')</label>
                <div class="relative">
                    <select name="hair_color" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                        @foreach ($hair_colors as $hair_color)
                        <option value="{{ $hair_color->id }}" {{ ($person->profile->hair_color == $hair_color->id ? "selected":"") }}>{{ $hair_color->name }}</option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>

            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">@lang('missing-persons::missing.height')</label>
                <input value="{{ $person->profile->height }}" data-validation="number" data-validation-allowing="range[1;250]" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="person-height" name="height" type="text" placeholder="">
            </div>
        </div>

        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-full-name">@lang('missing-persons::missing.description')</label>
                <textarea class="w-full border p-4 border-1" placeholder="" name="description" rows="6">{{ $person->profile->description }}</textarea>
            </div>
        </div>

        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="person-last-seen-date">@lang('missing-persons::missing.last_seen_on')</label>
                <input value="{{ $person->last_seen }}" data-date-format="yyyy-mm-dd" data-position="right top" class="datepicker-here appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="person-last-seen-date" name="last_seen_date" type="text">
            </div>
        </div>

        <div class="-mx-3 md:flex mb-2">
            <div class="md:w-2/4 px-3">
                <h2 class="block uppercase tracking-wide text-grey-darker text-md font-bold mb-2">@lang('missing-persons::missing.last_place')</h2>
            </div>
        </div>

        <div class="-mx-3 md:flex mb-2">
            <div class="md:w-2/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-region">@lang('missing-persons::missing.region')</label>
                <div class="relative">
                    <select name="region_id" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-region">
                        @foreach ($regions as $region)
                        <option data-lat="{{ $region->lat }}" data-lng="{{ $region->lng }}" value="{{ $region->id }}" {{ ($person->profile->region_id == $region->id ? "selected":"") }}>{{ $region->name }}</option>
                        @endforeach
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>

            <div class="md:w-2/4 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-settlement">@lang('missing-persons::missing.settlement')</label>
                <div class="relative">
                    <select name="settlement_id" class="block appearance-none w-full leading-tight bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-settlement">
                        @foreach ($settlements as $settlement)
                        <option data-lat="{{ $settlement->lat }}" data-lng="{{ $settlement->lng }}" value="{{ $settlement->id }}" {{ ($person->profile->settlement_id == $settlement->id ? "selected":"") }}>{{ $settlement->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="-mx-3 md:flex mt-4 mb-3">
            <div class="md:w-full md:flex px-3 mb-6 md:mb-0">
                <input type="checkbox" id="exact-address" name="exact_address" value="1" class="lcs_check" autocomplete="off" {{ ($person->last_place->exact_address == 1 ? "checked" : "") }} />
                <label class="ml-3 leading-loose md:w-3/4 block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="exact-address">@lang('missing-persons::missing.select_exact_address')</label>
            </div>
        </div>

        <div id="map-wrapper" @if($person->last_place->exact_address === 0) style="display:none;" @endif>
                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-full px-3 mb-6 md:mb-0 flex">
                        <input placeholder="Въведете точен адрес" value="{{ $person->last_place->address }}" class="flex-1 mr-2 appearance-none block w-full bg-grey-lighter text-grey-darker border border-red md:w-3/4 py-3 px-4" id="map-address" name="map_address" type="text">
                        <button type="button" id="button-search-address" class="appearance-none bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 md:w-1/4">@lang('missing-persons::missing.search')</button>
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
                <input type="file" id="file" class="filename" name="filename[]" data-fileuploader-extensions="jpg, png" data-fileuploader-files='@json($person->photos)'>
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
                    @lang('missing-persons::missing.save_edit_person')
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
	<script type="text/javascript" src="{{ asset('vendor/missing/js/air-datepicker/js/datepicker.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.js"></script>
	<script type="text/javascript" src="{{ asset('vendor/missing/js/pages/persons.edit.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/missing/js/pages/persons.edit.map.js') }}"></script>
@stop