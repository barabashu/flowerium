<?php
/**
 * Template part for displaying posts
 *
 * @package Flowerium
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <span class="posted-on"><?php echo get_the_date(); ?></span>
                <span class="byline"><?php _e('Автор:', 'flowerium'); ?> <?php the_author_posts_link(); ?></span>
            </div>
            <?php
        endif;
        ?>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php if (is_singular()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('flowerium-thumbnail'); ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) {
            the_content();
            
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Страницы:', 'flowerium'),
                'after'  => '</div>',
            ));
        } else {
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-outline mt-1">
                <?php _e('Читать далее', 'flowerium'); ?>
            </a>
            <?php
        }
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        $categories_list = get_the_category_list(', ');
        if ($categories_list) {
            echo '<span class="cat-links">' . __('Категории: ', 'flowerium') . $categories_list . '</span>';
        }

        $tags_list = get_the_tag_list('', ', ');
        if ($tags_list) {
            echo '<span class="tags-links">' . __('Теги: ', 'flowerium') . $tags_list . '</span>';
        }
        ?>
    </footer>
</article>
