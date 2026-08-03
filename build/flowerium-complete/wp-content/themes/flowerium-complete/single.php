<?php
/**
 * Single post template
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="entry-header" style="margin-bottom: 30px;">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-image" style="margin-bottom: 30px;">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: var(--border-radius);')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <div class="entry-meta" style="color: var(--color-text-light); margin-bottom: 20px;">
                        <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <?php if (get_the_author()) : ?>
                            <span style="margin-left: 20px;"><i class="far fa-user"></i> <?php the_author(); ?></span>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="entry-content" style="line-height: 1.8;">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . __('Страницы:', 'flowerium-complete'),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>

                <footer class="entry-footer" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--color-border);">
                    <?php
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) :
                        ?>
                        <div class="tags-links" style="margin-bottom: 20px;">
                            <strong><?php _e('Теги:', 'flowerium-complete'); ?></strong>
                            <?php echo $tags_list; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="share-links">
                        <strong><?php _e('Поделиться:', 'flowerium-complete'); ?></strong>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="social-link" style="display: inline-flex; margin-left: 10px;">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="social-link" style="display: inline-flex;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" rel="noopener" class="social-link" style="display: inline-flex;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="social-link" style="display: inline-flex;">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </div>
                </footer>
            </article>

            <?php
            // Post navigation
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . __('Предыдущая:', 'flowerium-complete') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . __('Следующая:', 'flowerium-complete') . '</span> <span class="nav-title">%title</span>',
                )
            );

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
