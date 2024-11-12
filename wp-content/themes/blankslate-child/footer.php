<?php
    $attach_file = get_field('attach_file', 'option');
    $attach_file_url = $attach_file['url'];

    $footer_icon = get_theme_mod('tooltyp_footer_icon'); 
    $footer_description = get_theme_mod('tooltyp_footer_description'); 
?>

<footer id="footer" role="contentinfo" class="section-footer">
    <div class="container-footer">
        <?php if ($attach_file): ?>
            <a class="download-content" href="<?php echo esc_url($attach_file_url); ?>" target="_blank">
        <?php else: ?>
            <div class="download-content">
        <?php endif; ?>

            <?php if ($footer_icon): ?>
                <img class="download-footer-icon" src="<?php echo esc_url($footer_icon); ?>" alt="Footer Icon">
            <?php endif; ?>
            
            <?php if ($footer_description): ?>
                <p class="download-footer-description"><?php echo esc_html($footer_description); ?></p>
            <?php endif; ?>

        <?php if ($attach_file): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
