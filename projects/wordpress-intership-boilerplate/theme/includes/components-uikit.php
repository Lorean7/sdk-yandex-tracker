<?php

function wib_theme_components_uikit_render(string $component_name, array $properties): void {
    get_template_part("components-uikit/$component_name/$component_name", null, $properties);
}

function wib_theme_components_uikit_stringify(string $name, array $properties): string {
    ob_start();

    wib_theme_components_uikit_render($name, $properties);

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function wib_theme_components_uikit_get_image(string $component_name, string $image_name, string $extension = 'svg'): array {
    return wib_theme_images_get_static_image("components-uikit/$component_name", "$component_name-$image_name", $extension);
}