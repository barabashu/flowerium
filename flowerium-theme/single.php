<?php
/**
 * The template for displaying single posts
 *
 * @package Flowerium
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', get_post_type());

            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . __('Предыдущая:', 'flowerium') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . __('Следующая:', 'flowerium') . '</span> <span class="nav-title">%title</span>',
            ));

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();
