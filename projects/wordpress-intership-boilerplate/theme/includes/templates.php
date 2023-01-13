<?php

add_filter('template_include', 'wib_theme_templates_replace_default_path');
function wib_theme_templates_replace_default_path($template) {
    if(is_page_template()) return $template;

    $_404_path = get_template_directory() . '/default-templates/404.php';
    if(is_404() && file_exists($_404_path)) {
        return $_404_path;
    }

    if(is_singular()) {
        $typed_single_path = get_template_directory() . '/default-templates/single-' . get_post_type() . '.php';
        if(file_exists($typed_single_path)) {
            return $typed_single_path;
        }

        $common_single_path = get_template_directory() . '/default-templates/single.php';
        if(file_exists($common_single_path)) {
            return $common_single_path;
        }
    }

    return wp_redirect(site_url());
}
