<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_child_schema_type(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="site-header">
            <div class="container-menu">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="Guía de facturación electrónica">Guía de facturación electrónica</a>
            </div>
        </header>