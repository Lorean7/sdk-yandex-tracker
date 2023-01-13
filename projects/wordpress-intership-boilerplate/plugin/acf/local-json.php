<?php

add_filter('acf/settings/save_json', function($path) {
    return __DIR__ . '/local-json';
});

add_filter('acf/settings/load_json', function($paths) {
    unset($paths[0]);

    $paths[] = __DIR__ . '/local-json';

    return $paths;
});

