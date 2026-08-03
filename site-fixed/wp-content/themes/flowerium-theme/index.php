<?php
/**
 * The main template file for Flowerium Theme (Fixed)
 *
 * This template converts the original HTML structure into WordPress PHP templates.
 * It maintains the exact design from the original project while adding WordPress functionality.
 * 
 * @package Flowerium Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php if (is_front_page()) : ?>
        
        <!-- Hero Section - from original index.html -->
        <section class="hero section-grid">
            <div class="hero__content">
                <p class="eyebrow"><?php echo esc_html(get_field('hero_eyebrow') ?: __('Свежие цветы каждый день', 'flowerium-theme')); ?></p>
                <h1><?php echo esc_html(get_field('hero_title') ?: __('Букеты, которые доставляют эмоции', 'flowerium-theme')); ?></h1>
                <p class="hero__lead"><?php echo esc_html(get_field('hero_description') ?: __('Собираем авторские композиции, присылаем фото перед отправкой и доставляем по городу в удобный интервал.', 'flowerium-theme')); ?></p>
                <div class="hero__actions">
                    <a class="button button--primary" href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>"><?php _e('Выбрать букет', 'flowerium-theme'); ?></a>
                    <a class="button button--ghost" href="<?php echo esc_url(get_permalink(get_page_by_path('contacts'))); ?>"><?php _e('Заказать консультацию', 'flowerium-theme'); ?></a>
                </div>
                <ul class="hero__facts" aria-label="<?php _e('Преимущества', 'flowerium-theme'); ?>">
                    <li><strong><?php _e('60 мин', 'flowerium-theme'); ?></strong><span><?php _e('срочная сборка', 'flowerium-theme'); ?></span></li>
                    <li><strong><?php _e('4.9/5', 'flowerium-theme'); ?></strong><span><?php _e('оценка клиентов', 'flowerium-theme'); ?></span></li>
                    <li><strong><?php _e('Фото', 'flowerium-theme'); ?></strong><span><?php _e('перед доставкой', 'flowerium-theme'); ?></span></li>
                </ul>
            </div>
            <div class="hero__card" aria-label="<?php _e('Пример букета', 'flowerium-theme'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-bouquet.svg" alt="<?php _e('Нежный букет Flowerium', 'flowerium-theme'); ?>">
                <div class="hero__price">
                    <span><?php _e('Хит недели', 'flowerium-theme'); ?></span>
                    <strong><?php _e('от 3 900 ₽', 'flowerium-theme'); ?></strong>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="section" id="categories">
            <div class="section__head">
                <p class="eyebrow"><?php _e('Категории', 'flowerium-theme'); ?></p>
                <h2><?php _e('Подберите букет под повод', 'flowerium-theme'); ?></h2>
            </div>
            <div class="category-grid">
                <?php
                // Try to get WooCommerce product categories
                if (class_exists('WooCommerce')) {
                    $product_categories = get_terms(array(
                        'taxonomy'   => 'product_cat',
                        'hide_empty' => false,
                        'number'     => 4,
                    ));
                    
                    if (!empty($product_categories) && !is_wp_error($product_categories)) {
                        foreach ($product_categories as $category) {
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';
                ?>
                    <article class="category-card">
                        <?php if ($image_url) : ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <?php endif; ?>
                        <h3><a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a></h3>
                        <p><?php echo esc_html($category->description); ?></p>
                    </article>
                <?php 
                        }
                    } else {
                ?>
                    <!-- Fallback static content from original HTML -->
                    <article class="category-card"><span>🌹</span><h3><?php _e('Розы', 'flowerium-theme'); ?></h3><p><?php _e('Классика для свидания, юбилея и признания.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>💐</span><h3><?php _e('Сборные букеты', 'flowerium-theme'); ?></h3><p><?php _e('Авторские сочетания сезонных цветов.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>🎁</span><h3><?php _e('Цветы в коробке', 'flowerium-theme'); ?></h3><p><?php _e('Эффектная подача и удобная доставка.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>🏢</span><h3><?php _e('Корпоративные', 'flowerium-theme'); ?></h3><p><?php _e('Композиции для клиентов, офиса и мероприятий.', 'flowerium-theme'); ?></p></article>
                <?php 
                    }
                } else {
                ?>
                    <!-- No WooCommerce - show static content -->
                    <article class="category-card"><span>🌹</span><h3><?php _e('Розы', 'flowerium-theme'); ?></h3><p><?php _e('Классика для свидания, юбилея и признания.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>💐</span><h3><?php _e('Сборные букеты', 'flowerium-theme'); ?></h3><p><?php _e('Авторские сочетания сезонных цветов.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>🎁</span><h3><?php _e('Цветы в коробке', 'flowerium-theme'); ?></h3><p><?php _e('Эффектная подача и удобная доставка.', 'flowerium-theme'); ?></p></article>
                    <article class="category-card"><span>🏢</span><h3><?php _e('Корпоративные', 'flowerium-theme'); ?></h3><p><?php _e('Композиции для клиентов, офиса и мероприятий.', 'flowerium-theme'); ?></p></article>
                <?php } ?>
            </div>
        </section>

        <!-- Popular Products Section -->
        <section class="section section--tint">
            <div class="section__head section__head--split">
                <div>
                    <p class="eyebrow"><?php _e('Популярное', 'flowerium-theme'); ?></p>
                    <h2><?php _e('Букеты для быстрой покупки', 'flowerium-theme'); ?></h2>
                </div>
                <a class="text-link" href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>"><?php _e('Весь каталог →', 'flowerium-theme'); ?></a>
            </div>
            <div class="product-grid">
                <?php
                if (class_exists('WooCommerce')) {
                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 3,
                        'meta_query'     => array(
                            array(
                                'key'     => '_featured',
                                'value'   => 'yes',
                                'compare' => '=',
                            ),
                        ),
                    );
                    
                    $featured_products = new WP_Query($args);
                    
                    if ($featured_products->have_posts()) {
                        while ($featured_products->have_posts()) {
                            $featured_products->the_post();
                            global $product;
                ?>
                    <article class="product-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo $product->get_image('product-thumb'); ?>
                        </a>
                        <div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                            <strong><?php echo $product->get_price_html(); ?></strong>
                        </div>
                        <button class="button button--small" type="button" data-product-id="<?php echo get_the_ID(); ?>"><?php _e('В корзину', 'flowerium-theme'); ?></button>
                    </article>
                <?php 
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p>' . __('Товары скоро появятся!', 'flowerium-theme') . '</p>';
                    }
                } else {
                ?>
                    <!-- Static fallback from original HTML -->
                    <article class="product-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bouquet-rose.svg" alt="<?php _e('Букет Розовый рассвет', 'flowerium-theme'); ?>">
                        <div>
                            <h3><?php _e('Розовый рассвет', 'flowerium-theme'); ?></h3>
                            <p><?php _e('Розы, эустома, эвкалипт', 'flowerium-theme'); ?></p>
                            <strong><?php _e('3 900 ₽', 'flowerium-theme'); ?></strong>
                        </div>
                        <button class="button button--small" type="button"><?php _e('В корзину', 'flowerium-theme'); ?></button>
                    </article>
                    <article class="product-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bouquet-spring.svg" alt="<?php _e('Букет Весенний день', 'flowerium-theme'); ?>">
                        <div>
                            <h3><?php _e('Весенний день', 'flowerium-theme'); ?></h3>
                            <p><?php _e('Тюльпаны, ирисы, зелень', 'flowerium-theme'); ?></p>
                            <strong><?php _e('2 700 ₽', 'flowerium-theme'); ?></strong>
                        </div>
                        <button class="button button--small" type="button"><?php _e('В корзину', 'flowerium-theme'); ?></button>
                    </article>
                    <article class="product-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bouquet-box.svg" alt="<?php _e('Цветы в коробке Кремовый комплимент', 'flowerium-theme'); ?>">
                        <div>
                            <h3><?php _e('Кремовый комплимент', 'flowerium-theme'); ?></h3>
                            <p><?php _e('Пионовидные розы в коробке', 'flowerium-theme'); ?></p>
                            <strong><?php _e('4 600 ₽', 'flowerium-theme'); ?></strong>
                        </div>
                        <button class="button button--small" type="button"><?php _e('В корзину', 'flowerium-theme'); ?></button>
                    </article>
                <?php } ?>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="section steps">
            <div class="section__head">
                <p class="eyebrow"><?php _e('Как это работает', 'flowerium-theme'); ?></p>
                <h2><?php _e('От заказа до улыбки получателя', 'flowerium-theme'); ?></h2>
            </div>
            <div class="steps__grid">
                <article>
                    <span>1</span>
                    <h3><?php _e('Выберите букет', 'flowerium-theme'); ?></h3>
                    <p><?php _e('Оформите заказ на сайте или напишите менеджеру.', 'flowerium-theme'); ?></p>
                </article>
                <article>
                    <span>2</span>
                    <h3><?php _e('Согласуем детали', 'flowerium-theme'); ?></h3>
                    <p><?php _e('Уточним адрес, интервал, открытку и способ оплаты.', 'flowerium-theme'); ?></p>
                </article>
                <article>
                    <span>3</span>
                    <h3><?php _e('Соберём и покажем', 'flowerium-theme'); ?></h3>
                    <p><?php _e('Отправим фото готового букета перед доставкой.', 'flowerium-theme'); ?></p>
                </article>
                <article>
                    <span>4</span>
                    <h3><?php _e('Доставим вовремя', 'flowerium-theme'); ?></h3>
                    <p><?php _e('Курьер передаст букет и сообщит о вручении.', 'flowerium-theme'); ?></p>
                </article>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section cta">
            <div>
                <p class="eyebrow"><?php _e('Нужен сайт под WordPress?', 'flowerium-theme'); ?></p>
                <h2><?php _e('Макет готов к переносу в тему или сборке как лендинг', 'flowerium-theme'); ?></h2>
                <p><?php _e('Структура учитывает каталог, формы, российские платежи, CRM, аналитику и будущую смену домена.', 'flowerium-theme'); ?></p>
            </div>
            <a class="button button--primary" href="<?php echo esc_url(get_permalink(get_page_by_path('contacts'))); ?>"><?php _e('Обсудить запуск', 'flowerium-theme'); ?></a>
        </section>

    <?php else : ?>
        
        <!-- Standard Page Content for non-front pages -->
        <div class="page-hero">
            <p class="eyebrow"><?php _e('Информация', 'flowerium-theme'); ?></p>
            <h1><?php the_title(); ?></h1>
        </div>
        
        <div class="section">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>

    <?php endif; ?>

</main>

<?php
get_footer();
