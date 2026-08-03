<?php
/**
 * Template helpers.
 *
 * @package Flowerium
 */

if (!defined('ABSPATH')) {
    exit;
}

function flowerium_default_menu(): void
{
    $items = [
        home_url('/') => __('Главная', 'flowerium'),
        home_url('/catalog/') => __('Каталог', 'flowerium'),
        home_url('/delivery/') => __('Доставка', 'flowerium'),
        home_url('/about/') => __('О нас', 'flowerium'),
        home_url('/contacts/') => __('Контакты', 'flowerium'),
    ];

    foreach ($items as $url => $label) {
        printf('<a href="%s">%s</a>', esc_url($url), esc_html($label));
    }
}

function flowerium_default_footer_menu(): void
{
    $items = [
        home_url('/catalog/') => __('Каталог', 'flowerium'),
        home_url('/delivery/') => __('Доставка и оплата', 'flowerium'),
        home_url('/contacts/') => __('Контакты', 'flowerium'),
    ];

    foreach ($items as $url => $label) {
        printf('<a href="%s">%s</a>', esc_url($url), esc_html($label));
    }
}
