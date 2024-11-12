<?php /* IMPORTANT! Since this block will be directly processed by WordPress's content() function, it is not necessary to use the loop `if ( have_posts() ) : while ( have_posts() ) : the_post();` */ ?>

<section class="section-hero">
    <div class="container-hero">
    <div class="swiper-container swiper-container-hero">
        <div class="swiper-wrapper">
            <?php if (have_rows('hero_repeater')): ?>
                <?php while (have_rows('hero_repeater')): the_row(); ?>
                    <?php
                        $background_image_section_hero = get_sub_field('background_image_section_hero');
                        $background_image_section_hero_url = $background_image_section_hero['url'];
                        $background_image_section_hero_alt = $background_image_section_hero['alt'];

                        $title_section_hero = get_sub_field('title_section_hero');
                        $description_section_hero = get_sub_field('description_section_hero');
                        $button_section_hero = get_sub_field('button_section_hero');

                        $button_section_hero_url = $button_section_hero['url'];
                        $button_section_hero_title = $button_section_hero['title'];
                        $button_section_hero_target = $button_section_hero['target'];
                    ?>
                    <div class="swiper-slide">
                        <img class="image-slide-cover" src="<?php echo esc_url($background_image_section_hero_url); ?>" alt="<?php echo esc_attr($background_image_section_hero_alt); ?>" />
                        <div class="slide-content">
                            <div class="container-slide-title">
                                <h2 class="slide-title"><?php echo esc_html($title_section_hero); ?></h2>
                            </div>
                            <div class="container-slide-description ">
                                <?php echo wp_kses_post($description_section_hero); ?>
                            </div>
                            <div class="container-slide-btn">
                                <a class="white-button" href="<?php echo esc_url($button_section_hero_url); ?>" target="<?php echo esc_attr($button_section_hero_target); ?>"><?php echo esc_html($button_section_hero_title); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination swiper-pagination-hero"></div>
    </div>
    
    </div>
</section>