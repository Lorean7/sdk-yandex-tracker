<?php

add_filter('script_loader_tag', 'wib_theme_pagespeed_add_defer_attribute', 10);
function wib_theme_pagespeed_add_defer_attribute($tag) {
    if(is_admin()) return $tag;
    return str_replace('<script ', '<script defer ', $tag);
}

add_action('wp_enqueue_scripts', 'wib_theme_pagespeed_dequeue_scripts', 9999);
function wib_theme_pagespeed_dequeue_scripts() {
    wp_dequeue_style('wp-block-library');
}

add_action('init', 'wib_theme_pagespeed_disable_embeds_code', 9999);
function wib_theme_pagespeed_disable_embeds_code() {
    add_filter('embed_oembed_discover', '__return_false');
    add_filter('rewrite_rules_array', 'wib_theme_pagespeed_disable_embeds_rewrites');

    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result');
}

add_action('init', 'wib_theme_pagespeed_disable_emojis');
function wib_theme_pagespeed_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('wp_resource_hints', 'wib_theme_pagespeed_disable_emojis_remove_dns_prefetch', 10, 2);
}

function wib_theme_pagespeed_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
        foreach ( $urls as $key => $url ) {
            if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
                unset( $urls[$key] );
            }
        }
    }
    return $urls;
}

function wib_theme_pagespeed_disable_embeds_rewrites($rules) {
    foreach($rules as $rule => $rewrite) {
        if(false !== strpos($rewrite, 'embed=true')) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}
