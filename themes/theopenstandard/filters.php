<?php
add_filter( 'coauthors_guest_author_fields', 'capx_filter_guest_author_fields', 10, 2);
function capx_filter_guest_author_fields($fields_to_return, $groups) {
    if (in_array('all', $groups) || in_array('contact-info', $groups)) {
        $fields_to_return[] = array(
            'key'      => 'twitter',
            'label'    => 'Twitter',
            'group'    => 'contact-info',
        );
        $fields_to_return[] = array(
            'key'      => 'facebook',
            'label'    => 'Facebook',
            'group'    => 'contact-info',
        );
        $fields_to_return[] = array(
            'key'      => 'googleplus',
            'label'    => 'Google Plus',
            'group'    => 'contact-info',
        );
    } 

    return $fields_to_return;
}
?>