<?php
/**
 * Main fallback template.
 *
 * @package Flowerium
 */
get_header();
?>
<main>
    <?php if (have_posts()) : ?>
        <section class="page-hero">
            <p class="eyebrow"><?php bloginfo('name'); ?></p>
            <h1><?php single_post_title(); ?></h1>
        </section>
        <div class="entry-content">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
            <?php the_posts_navigation(); ?>
        </div>
    <?php else : ?>
        <section class="page-hero"><p class="eyebrow"><?php esc_html_e('Flowerium', 'flowerium'); ?></p><h1><?php esc_html_e('Страница не найдена', 'flowerium'); ?></h1><p><?php esc_html_e('Попробуйте перейти в каталог или связаться с нами.', 'flowerium'); ?></p></section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
