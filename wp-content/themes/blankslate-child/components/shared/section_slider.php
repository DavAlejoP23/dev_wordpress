<?php /* IMPORTANT! Since this block will be directly processed by WordPress's content() function, it is not necessary to use the loop `if ( have_posts() ) : while ( have_posts() ) : the_post();` */ ?>

<section class="section-slider">
    <div class="container-slider">
        <div class="slider">
            <div class="swiper-container">
                <div class="cards-container swiper-wrapper">
                    <?php if (have_rows('repeater_cards')): ?>
                        <?php while (have_rows('repeater_cards')) : the_row(); ?>
                            <?php 
                                $image_slider = get_sub_field('image_slider');
                                $category_slider = get_sub_field('category_slider');
                                $title_slider = get_sub_field('title_slider');
                                $description_slider = get_sub_field('description_slider');

                                $image_slider_url = $image_slider['url'];
                                $image_slider_alt = $image_slider['alt'];
                                $image_slider_title = $image_slider['title'];
                            ?>
                            <div class="card swiper-slide">
                                <img class="card-image" src="<?php echo esc_url($image_slider_url); ?>" alt="<?php echo esc_html($image_slider_alt); ?>" title="<?php echo esc_html($image_slider_title); ?>" />
                                <div class="card-content">
                                    <h4 class="category"><?php echo esc_html($category_slider); ?></h4>
                                    <h3 class="title"><?php echo esc_html($title_slider); ?></h3>
                                    <?php echo wp_kses_post($description_slider); ?>
                                </div>
                            </div>  
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div> 
        </div>
    </div>
</section>