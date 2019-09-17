<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">	
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    {!! SEO::generate() !!}
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Styles -->
    <link type="text/css" href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/missing/css/custom.css') }}" rel="stylesheet">
    @yield('page_css')
</head>
<body class="h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-indigo-900 shadow mb-8 py-4">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
					<div class="ml-6 w-2/12">
						<div class="flex items-center flex-shrink-0 text-white mr-6">
							<a href="{{ url('/') }}" class="text-sm font-semibold text-gray-100 no-underline">
								<img src="{{ asset('vendor/missing/img/missing.logo.svg') }}" alt="logo" style="height: 41px;float: left;margin-right: 13px;">
								<span class="font-semibold text-sm tracking-tight">@lang('missing-persons::missing.site_title')</span>
							</a>
						</div>
					</div>
                    <div class="flex-1 text-right">
                        <a class="no-underline hover:underline text-gray-300 text-base p-3" href="{{ route('map.index') }}">@lang('missing-persons::missing.map')</a>
                        <a class="no-underline hover:underline text-gray-300 text-base p-3" href="{{ route('persons.index') }}">@lang('missing-persons::missing.missing_persons')</a>
                        <a class="rounded bg-white hover:bg-gray-100 no-underline hover:no-underline text-indigo-900 text-base p-3" href="{{ route('persons.create') }}">@lang('missing-persons::missing.add_person')</a>
                    </div>
                </div>
            </div>
        </nav>
		@yield('breadcrumbs')
        @yield('content')
    </div>
    <?php
        $collection = Route::getRoutes();
        $routes = [];
        foreach ($collection as $route) {
            $routes[$route->getName()] = $route->uri();
        }
    ?>	
    <script>
        window.routes = @json($routes);
        window.translations = {!! Cache::get('translations') !!};
    </script>
    <!-- Scripts -->
    @yield('page_js')
    <script src="{{ mix('js/app.js') }}"></script>
	<script src="{{ asset('vendor/missing/js/global.js') }}"></script>
</body>
</html>