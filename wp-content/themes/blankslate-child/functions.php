<?php
add_action( 'after_setup_theme', 'blankslate_child_setup' );
function blankslate_child_setup() {
    load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
    add_theme_support( 'appearance-tools' );
    add_theme_support( 'woocommerce' );
    global $content_width;
    if ( !isset( $content_width ) ) { $content_width = 1920; }
    register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}

add_action( 'admin_notices', 'blankslate_child_notice' );
function blankslate_child_notice() {
    $user_id = get_current_user_id();
    $admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $param = ( count( $_GET ) ) ? '&' : '?';
    if ( !get_user_meta( $user_id, 'blankslate_child_notice_dismissed_11' ) && current_user_can( 'manage_options' ) ) {
        echo '<div class="notice notice-info"><p><a href="' . esc_url( $admin_url ), esc_html( $param ) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'blankslate' ) . '</big></a>' . wp_kses_post( __( '<big><strong>🏆 Thank you for using BlankSlate!</strong></big>', 'blankslate' ) ) . '<p>' . esc_html__( 'Powering over 10k websites! Buy me a sandwich! 🥪', 'blankslate' ) . '</p><a href="https://github.com/bhadaway/blankslate/issues/57" class="button-primary" target="_blank"><strong>' . esc_html__( 'How do you use BlankSlate?', 'blankslate' ) . '</strong></a> <a href="https://opencollective.com/blankslate" class="button-primary" style="background-color:green;border-color:green" target="_blank"><strong>' . esc_html__( 'Donate', 'blankslate' ) . '</strong></a> <a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" style="background-color:purple;border-color:purple" target="_blank"><strong>' . esc_html__( 'Review', 'blankslate' ) . '</strong></a> <a href="https://github.com/bhadaway/blankslate/issues" class="button-primary" style="background-color:orange;border-color:orange" target="_blank"><strong>' . esc_html__( 'Support', 'blankslate' ) . '</strong></a></p></div>';
    }
}

add_action( 'admin_init', 'blankslate_child_notice_dismissed' );
function blankslate_child_notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['dismiss'] ) ) {
        add_user_meta( $user_id, 'blankslate_child_notice_dismissed_11', 'true', true );
    }
}

add_action( 'wp_enqueue_scripts', 'blankslate_child_enqueue' );
function blankslate_child_enqueue() {
    // Cargar estilo del tema hijo solamente
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
}

add_action( 'wp_footer', 'blankslate_child_footer' );
function blankslate_child_footer() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (deviceAgent.match(/(Android)/)) {
                $("html").addClass("android");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php
}

add_filter( 'document_title_separator', 'blankslate_child_document_title_separator' );
function blankslate_child_document_title_separator( $sep ) {
    $sep = esc_html( '|' );
    return $sep;
}

add_filter( 'the_title', 'blankslate_child_title' );
function blankslate_child_title( $title ) {
    if ( $title == '' ) {
        return esc_html( '...' );
    } else {
        return wp_kses_post( $title );
    }
}

function blankslate_child_schema_type() {
    $schema = 'https://schema.org/';
    if ( is_single() ) {
        $type = "Article";
    } elseif ( is_author() ) {
        $type = 'ProfilePage';
    } elseif ( is_search() ) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}

add_filter( 'nav_menu_link_attributes', 'blankslate_child_schema_url', 10 );
function blankslate_child_schema_url( $atts ) {
    $atts['itemprop'] = 'url';
    return $atts;
}

if ( ! function_exists( 'blankslate_child_wp_body_open' ) ) {
    function blankslate_child_wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

add_action( 'wp_body_open', 'blankslate_child_skip_link', 5 );
function blankslate_child_skip_link() {
    echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'blankslate' ) . '</a>';
}

add_filter( 'the_content_more_link', 'blankslate_child_read_more_link' );
function blankslate_child_read_more_link() {
    if ( !is_admin() ) {
        return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
    }
}

add_filter( 'excerpt_more', 'blankslate_child_excerpt_read_more_link' );
function blankslate_child_excerpt_read_more_link( $more ) {
    if ( !is_admin() ) {
        global $post;
        return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'blankslate' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
    }
}

add_filter( 'big_image_size_threshold', '__return_false' );

add_filter( 'intermediate_image_sizes_advanced', 'blankslate_child_image_insert_override' );
function blankslate_child_image_insert_override( $sizes ) {
    unset( $sizes['medium_large'] );
    unset( $sizes['1536x1536'] );
    unset( $sizes['2048x2048'] );
    return $sizes;
}

add_action( 'widgets_init', 'blankslate_child_widgets_init' );
function blankslate_child_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

// Deshabilitar comentarios
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

// Cerrar comentarios en los posts existentes
function disable_comments_existing_posts() {
    global $wpdb;
    $wpdb->query("UPDATE $wpdb->posts SET comment_status = 'closed', ping_status = 'closed' WHERE post_type != 'attachment'");
}
add_action('admin_init', 'disable_comments_existing_posts');

// Ocultar la opción de comentarios en el panel de administración
function hide_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'hide_comments_admin_menu');

// Redirigir cualquier solicitud de comentarios
function redirect_comment_form_to_posts() {
    global $pagenow;
    if ($pagenow === 'comment-post.php') {
        wp_redirect(home_url());
        exit();
    }
}
add_action('admin_init', 'redirect_comment_form_to_posts');

// Deshabilitar pingbacks y trackbacks
function disable_pingback_and_trackback( &$links ) {
    foreach ( $links as $link ) {
        if ( preg_match( '/<\/?p>/', $link ) ) {
            $disabled[] = $link;
        }
    }
    return $disabled;
}

function allow_svg_upload( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );


add_filter( 'pre_comment_content', 'disable_pingback_and_trackback' );
add_filter( 'comment_post', 'disable_pingback_and_trackback' );
add_filter( 'xmlrpc_methods', function( $methods ) {
    unset( $methods['pingback.ping'] );
    return $methods;
});

function dp_add_css(){
    wp_register_style ('dp-css', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('dp-css');
}
add_action('wp_enqueue_scripts', 'dp_add_css');

function dp_add_js(){
    wp_register_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);
    wp_enqueue_script('custom-js');
}
add_action('wp_enqueue_scripts', 'dp_add_js');

function swiper_register_styles() {
    wp_register_style('swiper-css', get_stylesheet_directory_uri() . '/assets/libraries/swiper/swiper-bundle.min.css', array(), '11.1.9', 'all');
    wp_register_script('swiper-js', get_stylesheet_directory_uri() . '/assets/libraries/swiper/swiper-bundle.min.js', array('jquery'), '11.1.9', true);
    wp_enqueue_style('swiper-css');
    wp_enqueue_script('swiper-js');
}
add_action('wp_enqueue_scripts', 'swiper_register_styles');

require get_stylesheet_directory() . '/theme/customize-header.php';

