<?php
    
    // Clear cache
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    
    // Index page
    Route::get('/', 'PersonController@index')->name('persons.index');
    
    // Map page
    Route::get('/map', 'MapController@index')->name('map.index');
    
    // Regions
    Route::get('regions', 'RegionController@index')->name('regions.index');
    Route::get('regions/create', 'RegionController@create')->name('regions.create');
    Route::get('regions/delete', 'RegionController@delete')->name('regions.delete');
    Route::resource('regions', 'RegionController');
    
    // Settlements
    Route::get('settlements/fetch/{region_id}', 'SettlementController@fetch')->name('settlements.fetch');
    
    // Persons
    Route::get('persons', 'PersonController@index')->name('persons.index');
    Route::get('persons/edit/{hash}', 'PersonController@edit')->name('persons.edit')->middleware('auth');
    Route::get('persons/view/{hash}', 'PersonController@view')->name('persons.view');
    Route::post('persons/store', 'PersonController@store')->name('persons.store');
    Route::get('persons/create', 'PersonController@create')->name('persons.create');
    Route::get('persons/delete', 'PersonController@delete')->name('persons.delete');
    Route::post('persons/photo/store', 'PersonController@store_photo')->name('persons.store_photo');
    Route::get('persons/photo/list', 'PersonController@list_photo')->name('persons.list_photo');
    Route::post('persons/photo/list/sort_order', 'PersonController@list_photo_sort')->name('persons.list_photo_sort');
    Route::resource('persons', 'PersonController');