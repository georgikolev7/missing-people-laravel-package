<?php
    
    // Clear cache
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    
    // Index page
    Route::get('/', 'PersonController@index')->name('persons.index');
    
    // Map page
    Route::get('/map', 'MapController@index')->name('map.index');
    
    // Map page
    Route::get('/page/{page}', 'PageController@index')->name('page.index');
    
    // Settlements
    Route::get('settlements/fetch/{region_id}', 'SettlementController@fetch')->name('settlements.fetch');
    
    // Persons
    Route::get('persons', 'PersonController@index')->name('persons.index');
    Route::get('persons/view/{hash}', 'PersonController@view')->name('persons.view');
    Route::get('persons/create', 'PersonController@create')->name('persons.create');
    
    // Persons restricted pages
    Route::middleware(['auth'])->group(function () {
        Route::get('persons/edit/{hash}', 'PersonController@edit')->name('persons.edit');
        Route::get('persons/delete/{hash}', 'PersonController@delete')->name('persons.delete');
        Route::get('persons/photo/list', 'PersonController@list_photo')->name('persons.list_photo');
        Route::post('persons/set_found/{hash}', 'PersonController@set_found')->name('persons.set_found');
        
        Route::post('persons/store', 'PersonController@store')->name('persons.store');
        Route::post('persons/update/{hash}', 'PersonController@update')->name('persons.update');
        Route::post('persons/photo/store', 'PersonController@store_photo')->name('persons.store_photo');
        Route::post('persons/photo/delete', 'PersonController@delete_photo')->name('persons.delete_photo');
        Route::post('persons/photo/list/sort_order', 'PersonController@list_photo_sort')->name('persons.list_photo_sort');
        
        // Regions
        Route::get('regions', 'RegionController@index')->name('regions.index');
        Route::get('regions/create', 'RegionController@create')->name('regions.create');
        Route::get('regions/delete', 'RegionController@delete')->name('regions.delete');
        Route::get('regions/edit/{id}', 'RegionController@edit')->name('regions.edit');
        Route::resource('regions', 'RegionController');
    });
    
    Route::resource('persons', 'PersonController');
    
    // Sitemap
    Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.index');
