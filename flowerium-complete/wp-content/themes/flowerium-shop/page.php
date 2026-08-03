<?php
/**
 * The template for displaying pages
 *
 * @package Flowerium_Shop
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="page-hero">
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
