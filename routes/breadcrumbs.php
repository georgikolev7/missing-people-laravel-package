<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('persons.index'));
});

// Map
Breadcrumbs::for('map', function ($trail) {
    $trail->parent('home');
    $trail->push('Map', route('map.index'));
});

// Map
Breadcrumbs::for('person_view', function ($trail, $person) {
    $trail->parent('home');
    $trail->push('Преглед', route('persons.view', $person->hash));
});