<?php

function wib_theme_images_get_static_image(string $dir, string $filename, string $extension = 'svg') {
    $offset = "$dir/$filename.$extension";

    $path = get_template_directory() . '/' . $offset;

    if(file_exists($path)) {
        $url = get_template_directory_uri() . '/' . $offset;

        if($extension === 'svg') {
            $xml = simplexml_load_file($path);

            if(isset($xml->attributes()->width) && isset($xml->attributes()->height)) {
                $width = $xml->attributes()->width;
                $height = $xml->attributes()->height;
            } else if(isset($xml->attributes()->viewBox)) {
                [$_, $__, $width, $height] = explode(' ', $xml->attributes()->viewBox);
            } else {
                $width = 0;
                $height = 0;
            }
        } else {
            [$width, $height] = getimagesize($path);
        }

        return [
            'url' => $url,
            'width' => $width,
            'height' => $height,
        ];
    } else {
        return [
            'url' => '',
            'width' => 0,
            'height' => 0,
        ];
    }
}

function wib_theme_images_get_content_of_static_svg_image(string $dir, string $filename): string {
    $offset = "$dir/$filename.svg";

    $path = get_template_directory() . '/' . $offset;

    if(file_exists($path)) {
        return file_get_contents($path);
    } else {
        return '<svg></svg>';
    }
}

function wib_theme_images_get_image_by_id($image_id, $size = 'full'): array {
    [ $url, $width, $height ] = wp_get_attachment_image_src($image_id, $size);

    $alt = trim(strip_tags(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
    $title = get_the_title($image_id);

    return [
        'url' => $url,
        'width' => $width,
        'height' => $height,
        'alt' => $alt,
        'title' => $title,
    ];
}

function wib_theme_images_get_post_thumbnail($post_id, $size = 'full') {
    return wib_theme_images_get_image_by_id(get_post_thumbnail_id($post_id), $size);
}
