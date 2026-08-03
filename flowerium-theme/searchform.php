<?php
/**
 * The template for displaying search form
 *
 * @package Flowerium
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php _e('Найти:', 'flowerium'); ?></span>
        <input type="search" class="search-field" placeholder="<?php _e('Поиск по сайту&hellip;', 'flowerium'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <span class="screen-reader-text"><?php _e('Найти', 'flowerium'); ?></span>
    </button>
</form>
