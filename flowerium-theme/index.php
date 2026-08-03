<?php
/**
 * The main template file
 *
 * @package Flowerium
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php if (is_home() && !is_front_page()) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php single_post_title(); ?></h1>
        </header>
    <?php endif; ?>

    <!-- Hero Section (only on front page) -->
    <?php if (is_front_page()) : ?>
        <section class="hero-section">
            <div class="container hero-content">
                <h1><?php _e('Свежие цветы с доставкой по Крыму', 'flowerium'); ?></h1>
                <p><?php _e('Авторские букеты, композиции и подарки для ваших близких. Доставка за 2 часа!', 'flowerium'); ?></p>
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary">
                        <?php _e('Перейти в каталог', 'flowerium'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <div class="container">
        <?php
        if (have_posts()) :
            if (is_home() && !is_front_page()) :
                ?>
                <header>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php
            endif;

            /* Start the Loop */
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;

            the_posts_navigation();

        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();
