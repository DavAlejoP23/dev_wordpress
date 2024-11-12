<?php
function tooltyp_customizer_settings($wp_customize) {
    // Crear el panel principal "Encabezado Personalizado Tooltyp"
    $wp_customize->add_panel('tooltyp_header_panel', array(
        'title' => __('Encabezado Personalizado Tooltyp', 'tooltyp'),
        'priority' => 10, // Coloca este panel en la primera posición
    ));

    // Configuración para el logo dentro del panel principal
    $wp_customize->add_section('tooltyp_logo_section', array(
        'title'    => __('Logo', 'tooltyp'),
        'priority' => 30,
        'panel'    => 'tooltyp_header_panel', // Asignar la sección al panel principal
    ));

    $wp_customize->add_setting('tooltyp_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'tooltyp_logo', array(
        'label'    => __('Upload Logo', 'tooltyp'),
        'section'  => 'tooltyp_logo_section',
        'settings' => 'tooltyp_logo',
    )));

    // Configuración para las redes sociales dentro del panel principal
    $wp_customize->add_section('tooltyp_social_section', array(
        'title'    => __('Redes Sociales', 'tooltyp'),
        'priority' => 31,
        'panel'    => 'tooltyp_header_panel', // Asignar la sección al panel principal
    ));

    $social_networks = array('facebook', 'twitter', 'instagram'); // Agrega o elimina redes según necesites

    foreach ($social_networks as $network) {
        // Campo para la URL de la red social
        $wp_customize->add_setting("tooltyp_{$network}_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("tooltyp_{$network}_url", array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'tooltyp_social_section',
            'type'    => 'url',
        ));

        // Campo para el ícono de la red social
        $wp_customize->add_setting("tooltyp_{$network}_icon");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "tooltyp_{$network}_icon", array(
            'label'    => ucfirst($network) . ' Icon',
            'section'  => 'tooltyp_social_section',
            'settings' => "tooltyp_{$network}_icon",
        )));
    }
}
add_action('customize_register', 'tooltyp_customizer_settings');
?>
