<?php
/**
 * The template for displaying pages
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="page-hero">
        <p class="eyebrow"><?php _e('Информация', 'flowerium'); ?></p>
        <h1><?php the_title(); ?></h1>
    </div>
    
    <div class="section">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>

</main>

<?php
get_footer();
