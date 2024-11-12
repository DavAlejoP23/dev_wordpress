<?php /* IMPORTANT! Since this block will be directly processed by WordPress's content() function, it is not necessary to use the loop `if ( have_posts() ) : while ( have_posts() ) : the_post();` */ ?>

<?php 
    $pre_title_section_newsletter = get_field('pre_title_section_newsletter') ?: '';
    $title_section_newsletter = get_field('title_section_newsletter') ?: '';
    $label_legal_notice_section_newsletter = get_field('label_legal_notice_section_newsletter') ?: '';
?>

<section class="section-newsletter">
    <div class="container-newsletter">
        <div class="container-all-form">
        <div class="container-title">
            <h3 class="pre-title-newsletter"><?php echo esc_html($pre_title_section_newsletter); ?></h3>
            <h2 class="title-newsletter"><?php echo esc_html($title_section_newsletter); ?></h2>
        </div>
        <div class="container-form-newsletter">
            <form id="newsletter_form" class="form-newsletter">
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Introduce tu e-mail" required>
                    <button type="submit" class="submit-button submit-icon" onclick="submitForm()"></button>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="legalNotice" name="legalNotice" required>
                    <label for="legalNotice"><?php echo esc_html($label_legal_notice_section_newsletter); ?></label>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>