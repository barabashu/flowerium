<?php
/**
 * Page template.
 *
 * @package Flowerium
 */
get_header();
?>
<main>
    <?php while (have_posts()) : the_post(); ?>
        <section class="page-hero">
            <p class="eyebrow"><?php bloginfo('name'); ?></p>
            <h1><?php the_title(); ?></h1>
        </section>
        <article class="entry-content">
            <?php the_content(); ?>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
