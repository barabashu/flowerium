<?php
/**
 * Comments template
 *
 * @package Flowerium_Complete
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    __('Один комментарий', 'flowerium-complete'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    _n('%1$s комментарий', '%1$s комментария', $comment_count, 'flowerium-complete'),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 50,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php _e('Комментарии закрыты.', 'flowerium-complete'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(
        array(
            'class_form'         => 'comment-form contact-form',
            'title_reply'        => __('Оставить комментарий', 'flowerium-complete'),
            'title_reply_to'     => __('Ответить: %s', 'flowerium-complete'),
            'cancel_reply_link'  => __('Отменить ответ', 'flowerium-complete'),
            'label_submit'       => __('Отправить комментарий', 'flowerium-complete'),
            'submit_button'      => '<button type="submit" id="%3$s" class="%4$s btn btn-primary">%1$s</button>',
            'fields'             => array(
                'author' => sprintf(
                    '<div class="form-group"><label for="author">%s</label><input id="author" name="author" type="text" value="%s" size="30" required /></div>',
                    __('Имя', 'flowerium-complete'),
                    esc_attr($comment_author)
                ),
                'email'  => sprintf(
                    '<div class="form-group"><label for="email">%s</label><input id="email" name="email" type="email" value="%s" size="30" required /></div>',
                    __('Email', 'flowerium-complete'),
                    esc_attr($comment_author_email)
                ),
                'url'    => sprintf(
                    '<div class="form-group"><label for="url">%s</label><input id="url" name="url" type="url" value="%s" size="30" /></div>',
                    __('Сайт', 'flowerium-complete'),
                    esc_attr($comment_author_url)
                ),
            ),
            'comment_field'      => sprintf(
                '<div class="form-group"><label for="comment">%s</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></div>',
                __('Комментарий', 'flowerium-complete')
            ),
        )
    );
    ?>
</div>
