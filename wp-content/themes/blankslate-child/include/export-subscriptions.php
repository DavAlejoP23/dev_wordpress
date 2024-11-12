<?php
// Crear el menú de exportación en el área de administración
function add_export_subscriptions_menu() {
    add_menu_page(
        'Exportar Suscripciones', // Título de la página
        'Exportar Suscripciones', // Título del menú
        'manage_options',         // Permisos
        'export-subscriptions',   // Slug de la página
        'export_subscriptions_page', // Función de callback que renderiza la página
        'dashicons-download',     // Ícono
        20                        // Posición en el menú
    );
}
add_action('admin_menu', 'add_export_subscriptions_menu');

// Mostrar el contenido de la página de exportación
function export_subscriptions_page() {
    ?>
    <div class="wrap">
        <h1>Exportar Suscripciones</h1>
        <p>Haz clic en el botón de abajo para descargar todas las suscripciones en un archivo CSV.</p>
        <form method="post" action="">
            <input type="hidden" name="export_subscriptions" value="1" />
            <?php submit_button('Descargar CSV'); ?>
        </form>
    </div>
    <?php
}

// Función para exportar suscripciones a CSV
function export_subscriptions_to_csv() {
    // Verifica si la exportación ha sido solicitada
    if (!is_admin() || !isset($_POST['export_subscriptions'])) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'dp_subscriptions_newsletter';

    // Consultar todas las suscripciones
    $results = $wpdb->get_results("SELECT * FROM {$table_name}", ARRAY_A);

    // Configuración de encabezados para descargar el archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=subscriptions.csv');

    $output = fopen('php://output', 'w');

    // Escribir encabezados en el archivo CSV
    fputcsv($output, array('ID', 'Email', 'UUID', 'Fecha de creación'));

    // Escribir cada fila de datos en el archivo CSV
    if (!empty($results)) {
        foreach ($results as $row) {
            fputcsv($output, $row);
        }
    }

    fclose($output);
    exit;
}
add_action('admin_init', 'export_subscriptions_to_csv');
