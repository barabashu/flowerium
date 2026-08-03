<?php
/** Template Name: Каталог */
get_header();
$products = [
    ['img' => 'img/bouquet-rose.svg', 'title' => 'Розовый рассвет', 'text' => 'Нежный букет с розами и эустомой.', 'price' => '3 900 ₽'],
    ['img' => 'img/bouquet-spring.svg', 'title' => 'Весенний день', 'text' => 'Яркий сезонный букет с тюльпанами.', 'price' => '2 700 ₽'],
    ['img' => 'img/bouquet-box.svg', 'title' => 'Кремовый комплимент', 'text' => 'Цветы в коробке с открыткой.', 'price' => '4 600 ₽'],
    ['img' => 'img/bouquet-bright.svg', 'title' => 'Яркое признание', 'text' => 'Контрастная композиция для вау-эффекта.', 'price' => '5 200 ₽'],
];
?>
<main>
    <section class="page-hero"><p class="eyebrow"><?php esc_html_e('Каталог', 'flowerium'); ?></p><h1><?php esc_html_e('Букеты для любого повода', 'flowerium'); ?></h1><p><?php esc_html_e('Выберите готовую композицию или отправьте пожелания — флорист соберёт индивидуальный букет.', 'flowerium'); ?></p></section>
    <section class="catalog-layout">
        <aside class="filters"><h2><?php esc_html_e('Фильтры', 'flowerium'); ?></h2><label><?php esc_html_e('Цена', 'flowerium'); ?><select><option><?php esc_html_e('Любая', 'flowerium'); ?></option><option><?php esc_html_e('До 3000 ₽', 'flowerium'); ?></option><option><?php esc_html_e('3000–5000 ₽', 'flowerium'); ?></option><option><?php esc_html_e('От 5000 ₽', 'flowerium'); ?></option></select></label><label><?php esc_html_e('Повод', 'flowerium'); ?><select><option><?php esc_html_e('Любой', 'flowerium'); ?></option><option><?php esc_html_e('День рождения', 'flowerium'); ?></option><option><?php esc_html_e('Свидание', 'flowerium'); ?></option></select></label><label class="checkbox"><input type="checkbox"> <?php esc_html_e('Доставка сегодня', 'flowerium'); ?></label><a class="button button--primary" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Подобрать букет', 'flowerium'); ?></a></aside>
        <div class="product-grid product-grid--catalog">
            <?php foreach ($products as $product) : ?>
                <article class="product-card"><img src="<?php echo flowerium_asset($product['img']); ?>" alt="<?php echo esc_attr($product['title']); ?>"><div><h3><?php echo esc_html($product['title']); ?></h3><p><?php echo esc_html($product['text']); ?></p><strong><?php echo esc_html($product['price']); ?></strong></div><a class="button button--small" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Заказать', 'flowerium'); ?></a></article>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
