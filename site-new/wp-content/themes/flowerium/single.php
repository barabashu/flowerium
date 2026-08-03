<?php
/**
 * The template for displaying single posts
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="section">
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="page-hero">
                    <p class="eyebrow"><?php _e('Блог', 'flowerium'); ?></p>
                    <h1><?php the_title(); ?></h1>
                    
                    <div class="entry-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <?php if (get_the_author()) : ?>
                            <span><?php _e('Автор:', 'flowerium'); ?> <?php the_author(); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div style="margin-bottom: 32px;">
                        <?php the_post_thumbnail('hero-image'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                
                <?php
                // Post tags
                $tags_list = get_the_tag_list('', ', ');
                if ($tags_list) {
                    echo '<div class="entry-tags mt-2"><strong>' . __('Теги:', 'flowerium') . '</strong> ' . $tags_list . '</div>';
                }
                ?>
            </article>
            
            <?php
            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . __('←', 'flowerium') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-title">%title</span> <span class="nav-subtitle">' . __('→', 'flowerium') . '</span>',
            ));
            
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile;
        ?>
    </div>

</main>

<?php
get_footer();
