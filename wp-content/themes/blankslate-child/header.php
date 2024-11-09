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
            <div class="menu">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="tooltyp logo">
                    <?php 
                    $logo = get_theme_mod('tooltyp_logo'); 
                        if ($logo) : ?>
                            <img src="<?php echo esc_url($logo); ?>" alt="tooltyp logo">
                        <?php else : ?>
                            <span>Logo</span> 
                        <?php endif; ?>
                 </a>

                <div class="container-social-networks">
                    <?php 
                        $social_networks = array('facebook', 'twitter', 'instagram');
                
                        foreach ($social_networks as $network) :
                            $url = get_theme_mod("tooltyp_{$network}_url");
                            $icon = get_theme_mod("tooltyp_{$network}_icon");

                        if ($url && $icon) : ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" aria-label="<?php echo ucfirst($network); ?>">
                                <img src="<?php echo esc_url($icon); ?>" alt="<?php echo ucfirst($network); ?> Icon">
                            </a>
                        <?php endif;
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </header>