<?php
/**
 * Product preview section.
 *
 * @package Flowerium
 */
$products = [
    ['img' => 'img/bouquet-rose.svg', 'title' => 'Розовый рассвет', 'text' => 'Розы, эустома, эвкалипт', 'price' => '3 900 ₽'],
    ['img' => 'img/bouquet-spring.svg', 'title' => 'Весенний день', 'text' => 'Тюльпаны, ирисы, зелень', 'price' => '2 700 ₽'],
    ['img' => 'img/bouquet-box.svg', 'title' => 'Кремовый комплимент', 'text' => 'Пионовидные розы в коробке', 'price' => '4 600 ₽'],
];
?>
<section class="section section--tint">
    <div class="section__head section__head--split">
        <div><p class="eyebrow"><?php esc_html_e('Популярное', 'flowerium'); ?></p><h2><?php esc_html_e('Букеты для быстрой покупки', 'flowerium'); ?></h2></div>
        <a class="text-link" href="<?php echo esc_url(home_url('/catalog/')); ?>"><?php esc_html_e('Весь каталог →', 'flowerium'); ?></a>
    </div>
    <div class="product-grid">
        <?php foreach ($products as $product) : ?>
            <article class="product-card">
                <img src="<?php echo flowerium_asset($product['img']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                <div><h3><?php echo esc_html($product['title']); ?></h3><p><?php echo esc_html($product['text']); ?></p><strong><?php echo esc_html($product['price']); ?></strong></div>
                <a class="button button--small" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Заказать', 'flowerium'); ?></a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
