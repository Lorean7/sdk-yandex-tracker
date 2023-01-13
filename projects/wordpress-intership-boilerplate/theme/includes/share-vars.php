<?php

add_action('wp_enqueue_scripts', function() {
    $vars = apply_filters('wib_share_vars', [
        'ajax_url' => site_url() . '/wp-admin/admin-ajax.php',
    ]);

    $js = 'var php_vars = ' . json_encode($vars, JSON_UNESCAPED_UNICODE) . ';';

    wp_add_inline_script('jquery', $js, 'before');
});
