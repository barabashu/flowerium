<?php
/**
 * The template for displaying posts
 *
 * @package Flowerium
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('category-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('product-thumb'); ?>
        </a>
    <?php endif; ?>
    
    <div class="entry-header">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        
        <div class="entry-meta">
            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
            <?php if (get_the_author()) : ?>
                <span><?php _e('Автор:', 'flowerium'); ?> <?php the_author(); ?></span>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    
    <a href="<?php the_permalink(); ?>" class="text-link"><?php _e('Читать далее →', 'flowerium'); ?></a>
</article>
