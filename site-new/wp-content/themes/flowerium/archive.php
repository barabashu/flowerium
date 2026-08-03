<?php
/**
 * The template for displaying archive pages
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="section">
        <div class="page-hero">
            <p class="eyebrow"><?php _e('Архив', 'flowerium'); ?></p>
            <?php
            the_archive_title('<h1>', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </div>
        
        <?php if (have_posts()) : ?>
            
            <div class="product-grid product-grid--catalog">
                <?php while (have_posts()) : the_post(); ?>
                    get_template_part('template-parts/content', get_post_type());
                <?php endwhile; ?>
            </div>
            
            <div class="text-center mt-3">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← Назад', 'flowerium'),
                    'next_text' => __('Вперёд →', 'flowerium'),
                ));
                ?>
            </div>
            
        <?php else : ?>
            
            <p><?php _e('В этом архиве пока нет материалов.', 'flowerium'); ?></p>
            
        <?php endif; ?>
    </div>

</main>

<?php
get_footer();
