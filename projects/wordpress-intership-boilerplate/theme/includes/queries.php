<?php

function wib_theme_queries_get_logo() {
    $image_id = get_theme_mod('custom_logo');

    return $image_id
        ? wib_theme_images_get_image_by_id($image_id, 'full')
        : false;
}
