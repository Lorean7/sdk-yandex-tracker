<?php

add_action('after_setup_theme', 'wib_theme_navigation_register_menus');
function wib_theme_navigation_register_menus() {
    register_nav_menus([
        'primary' => __('Primary', 'wib'),
    ]);
}

function wib_theme_navigation_get_primary_menu(): array {
    $locations = get_nav_menu_locations();

    return array_map(function ($item) {
        return [
            'id' => $item->ID,
            'title' => $item->post_title ?: $item->title,
            'target' => $item->url,
            'classes' => implode(' ', $item->classes),
        ];
    }, wp_get_nav_menu_items($locations['primary']));
}
