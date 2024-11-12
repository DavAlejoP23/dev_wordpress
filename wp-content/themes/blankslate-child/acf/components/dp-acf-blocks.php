<?php

function dp_acf_blocks_init() {

    acf_register_block_type(array(
        'name' => 'section-hero',
        'title' => __('Section Hero'),
        'description' => __('A custom section for the hero'),
        'render_template' => 'components/shared/hero.php',
        'category' => 'formatting',
        'icon' => 'admin-comments',
        'keywords' => array('section', 'hero', 'tooltyp'),
    ));

    acf_register_block_type(array(
        'name' => 'section-resume',
        'title' => __('Section Resume'),
        'description' => __('A custom section for the resume'),
        'render_template' => 'components/shared/section_resume.php',
        'category' => 'formatting',
        'icon' => 'admin-comments',
        'keywords' => array('section', 'resume', 'tooltyp'),
    ));

    acf_register_block_type(array(
        'name' => 'section-slider',
        'title' => __('Section Slider'),
        'description' => __('A custom section for the slider'),
        'render_template' => 'components/shared/section_slider.php',
        'category' => 'formatting',
        'icon' => 'admin-comments',
        'keywords' => array('section', 'slider', 'tooltyp'),
    ));

}

add_action('acf/init', 'dp_acf_blocks_init');

add_action( 'init', function() {
    flush_rewrite_rules();
} );

?>