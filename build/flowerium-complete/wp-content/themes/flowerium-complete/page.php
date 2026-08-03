<?php
/**
 * Template for displaying all pages
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        
        <div class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </div>

        <div class="page-content">
            <div class="container">
                <div class="content-wrapper">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . __('Страницы:', 'flowerium-complete'),
                            'after'  => '</div>',
                        )
                    );

                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                </div>
            </div>
        </div>

        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
