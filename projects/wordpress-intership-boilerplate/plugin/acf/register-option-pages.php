<?php

add_action('init', function() {
    acf_add_options_page([
        'page_title' 	=> __('Options', 'wib'),
        'menu_title'	=> __('Options', 'wib'),
        'menu_slug' 	=> 'wib-options',
        'capability'	=> 'manage_options',
        'autoload'      => true,
    ]);
});
