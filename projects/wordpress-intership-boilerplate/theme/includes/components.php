<?php

function wib_theme_components_render(string $component_name, array $properties): void {
    get_template_part("components/$component_name/$component_name", null, $properties);
}

function wib_theme_components_stringify(string $component_name, array $properties): string {
    ob_start();

    wib_theme_components_render($component_name, $properties);

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function wib_theme_components_get_image(string $component_name, string $image_name, string $extension = 'svg'): array {
    return wib_theme_images_get_static_image("components/$component_name", "$component_name-$image_name", $extension);
}
