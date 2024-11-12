<?php /* IMPORTANT! Since this block will be directly processed by WordPress's content() function, it is not necessary to use the loop `if ( have_posts() ) : while ( have_posts() ) : the_post();` */ ?>

<?php

$pre_title_section_resume = get_field('pre_title_section_resume') ?: '';
$title_section_resume = get_field('title_section_resume') ?: '';
$description_section_resume = get_field('description_section_resume') ?: '';

$button_section_resume = get_field('button_section_resume') ?: [];
$button_section_resume_url = $button_section_resume['url'] ?? '#';
$button_section_resume_title = $button_section_resume['title'] ?? 'Leer más';
$button_section_resume_target = $button_section_resume['target'] ?? '_self';
?>

<section class="section-resume">
    <div class="container container-resume">
        <div class="container-title">
            <h3 class="pre-title-resume"><?php echo esc_html($pre_title_section_resume); ?></h3>
            <h2 class="title-resume"><?php echo esc_html($title_section_resume); ?></h2>
        </div>
        <div class="container-description-resume">
            <?php echo wp_kses_post($description_section_resume); ?>
        </div>
        <div class="container-btn">
            <a class="deep-purple-button" href="<?php echo esc_url($button_section_resume_url); ?>" target="<?php echo esc_attr($button_section_resume_target); ?>">
                <?php echo esc_html($button_section_resume_title); ?>
            </a>
        </div>
    </div>
</section>
