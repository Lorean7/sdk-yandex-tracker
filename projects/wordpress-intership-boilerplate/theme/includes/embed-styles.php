<?php

add_action('wp_print_styles', function () {
    global $wp_styles;

    $exclude = [
        'admin-bar',
        'dashicons',
        'wp-fastest-cache-toolbar',
    ];

    $styles_to_inline = [];
    foreach($wp_styles->queue as $handle) {
        if(in_array($handle, $exclude)) continue;

        $styles_to_inline[$handle] = wp_make_link_relative($wp_styles->registered[$handle]->src);
    }

    $wp_styles->queue = array_filter($wp_styles->queue, function($handle) use($styles_to_inline) {
        return !isset($styles_to_inline[$handle]);
    });

    foreach ($styles_to_inline as $handle => $src) {
        $absolute_path = ABSPATH . $src;

        if(file_exists($absolute_path)) {
            $content = file_get_contents($absolute_path);

            echo '<style id="' . $handle . '">' . $content . '</style>';
        }
    }
}, PHP_INT_MAX);
