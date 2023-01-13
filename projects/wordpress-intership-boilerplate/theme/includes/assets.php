<?php

add_action('wp_enqueue_scripts', 'wib_theme_assets_enqueue');
function wib_theme_assets_enqueue() {
    $styles_relative_path = '/assets/dist/index.min.css';
    $scripts_relative_path = '/assets/dist/index.min.js';

    wp_enqueue_style(
        'theme-index',
        get_template_directory_uri() . $styles_relative_path,
        [],
        filemtime(get_template_directory() . $styles_relative_path),
    );

    wp_enqueue_script(
        'theme-index',
        get_template_directory_uri() . $scripts_relative_path,
        ['jquery'],
        filemtime(get_template_directory() . $scripts_relative_path),
        true,
    );
}
