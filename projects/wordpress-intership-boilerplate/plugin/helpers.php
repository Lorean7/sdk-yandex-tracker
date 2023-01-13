<?php

function wib_filesystem_scandir($path) {
    return array_values(array_filter(scandir($path), function($entity) {
        return !in_array($entity, ['.', '..']);
    }));
}

function wib_merge_args($defaults, $args) {
    $result = $defaults;

    foreach ($args as $key => $value) {
        if (is_array($value) && isset($result[$key])) {
            $result[$key] = wib_merge_args($result[$key], $value);
        } else {
            $result[$key] = $value;
        }
    }

    return $result;
}
