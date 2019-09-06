@extends('missing-persons::layouts.default')

@section('robots', 'noindex, nofollow')

@section('page_css')
@stop

@section('content')
    <div class="w-full md:max-w-2xl mx-auto flex bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="region-name">
                    @lang('missing.region_name')
                </label>
                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" name="name" id="region-name" type="text" placeholder="@lang('missing.placeholder_region_name')">
                <p class="text-red text-xs italic">@lang('missing.please_fill_region_name')</p>
            </div>
            <div class="md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                    @lang('missing.ekatte')
                </label>
                <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" placeholder="Doe">
            </div>
      </div>
    </div>
@endsection

@section('page_js')
@stop