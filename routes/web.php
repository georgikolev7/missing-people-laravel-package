<?php
    
    // Clear cache
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    
    // Regions
    Route::get('regions', 'RegionController@index')->name('regions.index');
    Route::get('regions/create', 'RegionController@create')->name('regions.create');
    Route::get('regions/delete', 'RegionController@delete')->name('regions.delete');
    Route::resource('regions', 'RegionController');
    
    // Persons
    Route::get('persons', 'PersonController@index')->name('persons.index');
    Route::get('persons/edit/{hash}', 'PersonController@edit')->name('persons.edit');
    Route::get('persons/view/{hash}', 'PersonController@view')->name('persons.view');
    Route::get('persons/create', 'PersonController@create')->name('persons.create');
    Route::get('persons/delete', 'PersonController@delete')->name('persons.delete');
    Route::resource('persons', 'PersonController');