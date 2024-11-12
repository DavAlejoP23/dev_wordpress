<?php
// Bloque de ACF para mostrar los últimos 3 posts en un slider

// Consulta para obtener los últimos 3 posts
$recent_posts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'order' => 'ASC',
]);
?>

<section class="section-slider">
    <div class="container-slider">
        <div class="slider">
            <div class="swiper-container swiper-container-slider">
                <div class="cards-container swiper-wrapper">
                    <?php if ($recent_posts->have_posts()): ?>
                        <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                            <?php 
                                $post_id = get_the_ID();

                                // Obtener la imagen destacada
                                $image_slider_url = get_the_post_thumbnail_url($post_id, 'large');
                                $image_slider_alt = get_the_title();

                                // Obtener la categoría principal del post
                                $categories = get_the_category();
                                $category_slider = !empty($categories) ? esc_html($categories[0]->name) : '';

                                // Obtener el título y el campo personalizado "Post Review"
                                $title_slider = get_the_title();
                                $post_review = get_field('post_review', $post_id); // Cambia 'post_review' al nombre del campo que creaste

                                // Obtener el enlace del post con el slug
                                $post_link = get_permalink($post_id); // Esto genera el enlace usando solo el slug según la configuración de enlaces permanentes de WordPress
                            ?>
                            <a class="card swiper-slide" href="<?php echo esc_url($post_link); ?>">
                                <?php if ($image_slider_url): ?>
                                    <img class="card-image" src="<?php echo esc_url($image_slider_url); ?>" alt="<?php echo esc_attr($image_slider_alt); ?>" />
                                <?php endif; ?>
                                <div class="card-content">
                                    <h4 class="category"><?php echo $category_slider; ?></h4>
                                    <h3 class="title"><?php echo $title_slider; ?></h3>
                                    <p class="review"><?php echo $post_review; ?></p>
                                </div>
                            </a>  
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else: ?>
                        <p><?php esc_html_e('No posts available', 'textdomain'); ?></p>
                    <?php endif; ?>
                </div>
            </div> 
        </div>
    </div>
</section>
