<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    @yield('page_css')
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-indigo-900 shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="ml-6">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            @lang('missing-persons::missing.site_title')
                        </a>
                    </div>
                    <div class="flex-1 text-right">
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('map.index') }}">@lang('missing-persons::missing.map')</a>
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('persons.index') }}">@lang('missing-persons::missing.missing_persons')</a>
                        <a class="rounded bg-white hover:bg-gray-100 no-underline hover:no-underline text-indigo-900 text-sm p-3" href="{{ route('persons.create') }}">@lang('missing-persons::missing.add_person')</a>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    
    <?php
        $collection = Route::getRoutes();
        $routes = [];
        foreach($collection as $route) {
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
</body>
</html>
