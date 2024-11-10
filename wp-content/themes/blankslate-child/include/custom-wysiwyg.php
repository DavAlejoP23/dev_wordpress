<?php

// Create toolbars for ACF WYSIWYG fields
function dp_acf_wysiwyg_toolbars( $toolbars ) {
    // Create a new toolbar called 'Solo Párrafos'
    $toolbars['Solo Párrafos y Listas'] = array();
    $toolbars['Solo Párrafos y Listas'][1] = array('bold', 'italic', 'bullist', 'numlist', 'link', 'unlink', 'removeformat');
    
    return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'dp_acf_wysiwyg_toolbars');

function dp_acf_wysiwyg_custom_format($init_array) {
    global $current_screen;
    if ($current_screen && $current_screen->id === 'edit-your_custom_post_type') {
        // Set the 'block_formats' to 'Paragraph=p' for the custom post type
        if (isset($_GET['post']) && get_post_meta($_GET['post'], 'another_acf_field_key', true)) {
            $init_array['block_formats'] = 'Paragraph=p';
        }
    }
    return $init_array;
}
add_filter('tiny_mce_before_init', 'dp_acf_wysiwyg_custom_format');

function dp_custom_allowed_paragraphs_and_list_tags($content) {
    // Define the permitted tags ('solo párrafos y listas')
    $allowed_paragraph_list_tags = array(
        'p'   => array(),
        'ul'  => array(),
        'ol'  => array(),
        'li'  => array(),
        'strong' => array(),
        'em'  => array(),
        'a'   => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
        ),
    );

    return wp_kses($content, $allowed_paragraph_list_tags);
}

?>
