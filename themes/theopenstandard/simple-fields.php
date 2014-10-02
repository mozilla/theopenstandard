<?php
 
function simple_fields_modify_connector_for_post($connector, $post) {
    // If post has sponsored category show the sponsored fields.
    if (has_category('sponsored', $post) || get_post_format($post) == 'gallery')
        $connector = 'simple_fields';

    return $connector;
}

add_filter("simple_fields_get_selected_connector_for_post", "simple_fields_modify_connector_for_post", 10, 2);

function simple_fields_modify_post_edit_side_field_settings($show_simple_fields, $post) {
    // Don't show the dropdown if the current post has sponsored category.
    // if (has_category('sponsored', $post))
    $show_simple_fields = false;

    return $show_simple_fields;
}
 
add_filter("simple_fields_add_post_edit_side_field_settings", "simple_fields_modify_post_edit_side_field_settings", 10, 2);