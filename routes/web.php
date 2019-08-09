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