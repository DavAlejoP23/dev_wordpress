<?php
function tooltyp_customizer_footer_settings($wp_customize) {
    // Panel de footer personalizado
    $wp_customize->add_panel('tooltyp_footer_panel', array(
        'title' => __('Footer Personalizado Tooltyp', 'tooltyp'),
        'priority' => 20,
    ));

    // Sección para el ícono del footer
    $wp_customize->add_section('tooltyp_footer_icon_section', array(
        'title'    => __('Ícono del Footer', 'tooltyp'),
        'priority' => 10,
        'panel'    => 'tooltyp_footer_panel',
    ));

    $wp_customize->add_setting('tooltyp_footer_icon');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'tooltyp_footer_icon', array(
        'label'    => __('Subir Ícono del Footer', 'tooltyp'),
        'section'  => 'tooltyp_footer_icon_section',
        'settings' => 'tooltyp_footer_icon',
    )));

    // Sección para la descripción del footer
    $wp_customize->add_section('tooltyp_footer_description_section', array(
        'title'    => __('Descripción del Footer', 'tooltyp'),
        'priority' => 11,
        'panel'    => 'tooltyp_footer_panel',
    ));

    $wp_customize->add_setting('tooltyp_footer_description', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_footer_description', // Asegura que el texto sea seguro y limitado a 10 palabras
    ));

    $wp_customize->add_control('tooltyp_footer_description', array(
        'label'    => __('Descripción del Footer', 'tooltyp'),
        'section'  => 'tooltyp_footer_description_section',
        'type'     => 'textarea',
        'description' => __('Máximo 10 palabras.'),
    ));
}
add_action('customize_register', 'tooltyp_customizer_footer_settings');

// Filtro para limitar la descripción del footer a 10 palabras
function sanitize_footer_description($input) {
    $words = explode(' ', $input);
    if (count($words) > 10) {
        $words = array_slice($words, 0, 10); // Limita a 10 palabras
    }
    return implode(' ', $words);
}
?>
