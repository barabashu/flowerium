<?php
/**
 * The main template file
 *
 * @package Flowerium
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php if (is_front_page()) : ?>
        
        <!-- Hero Section -->
        <section class="hero section-grid">
            <div class="hero__content">
                <p class="eyebrow"><?php echo esc_html(get_field('hero_eyebrow') ?: __('Свежие цветы каждый день', 'flowerium')); ?></p>
                <h1><?php echo esc_html(get_field('hero_title') ?: __('Букеты, которые доставляют эмоции', 'flowerium')); ?></h1>
                <p class="hero__lead"><?php echo esc_html(get_field('hero_description') ?: __('Собираем авторские композиции, присылаем фото перед отправкой и доставляем по городу в удобный интервал.', 'flowerium')); ?></p>
                <div class="hero__actions">
                    <a class="button button--primary" href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>"><?php _e('Выбрать букет', 'flowerium'); ?></a>
                    <a class="button button--ghost" href="<?php echo esc_url(get_permalink(get_page_by_path('contacts'))); ?>"><?php _e('Заказать консультацию', 'flowerium'); ?></a>
                </div>
                <ul class="hero__facts" aria-label="<?php _e('Преимущества', 'flowerium'); ?>">
                    <li><strong><?php _e('60 мин', 'flowerium'); ?></strong><span><?php _e('срочная сборка', 'flowerium'); ?></span></li>
                    <li><strong><?php _e('4.9/5', 'flowerium'); ?></strong><span><?php _e('оценка клиентов', 'flowerium'); ?></span></li>
                    <li><strong><?php _e('Фото', 'flowerium'); ?></strong><span><?php _e('перед доставкой', 'flowerium'); ?></span></li>
                </ul>
            </div>
            <div class="hero__card" aria-label="<?php _e('Пример букета', 'flowerium'); ?>">
                <?php 
                $hero_image = get_field('hero_image');
                if ($hero_image) :
                ?>
                    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt'] ?: __('Нежный букет Flowerium', 'flowerium')); ?>">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-bouquet.svg" alt="<?php _e('Нежный букет Flowerium', 'flowerium'); ?>">
                <?php endif; ?>
                <div class="hero__price">
                    <span><?php _e('Хит недели', 'flowerium'); ?></span>
                    <strong><?php _e('от 3 900 ₽', 'flowerium'); ?></strong>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="section" id="categories">
            <div class="section__head">
                <p class="eyebrow"><?php _e('Категории', 'flowerium'); ?></p>
                <h2><?php _e('Подберите букет под повод', 'flowerium'); ?></h2>
            </div>
            <div class="category-grid">
                <?php
                $product_categories = get_terms(array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false,
                    'number'     => 4,
                ));
                
                if (!empty($product_categories) && !is_wp_error($product_categories)) :
                    foreach ($product_categories as $category) :
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
                    endforeach;
                else :
                ?>
                    <article class="category-card"><span>🌹</span><h3><?php _e('Розы', 'flowerium'); ?></h3><p><?php _e('Классика для свидания, юбилея и признания.', 'flowerium'); ?></p></article>
                    <article class="category-card"><span>💐</span><h3><?php _e('Сборные букеты', 'flowerium'); ?></h3><p><?php _e('Авторские сочетания сезонных цветов.', 'flowerium'); ?></p></article>
                    <article class="category-card"><span>🎁</span><h3><?php _e('Цветы в коробке', 'flowerium'); ?></h3><p><?php _e('Эффектная подача и удобная доставка.', 'flowerium'); ?></p></article>
                    <article class="category-card"><span>🏢</span><h3><?php _e('Корпоративные', 'flowerium'); ?></h3><p><?php _e('Композиции для клиентов, офиса и мероприятий.', 'flowerium'); ?></p></article>
                <?php endif; ?>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="section section--tint">
            <div class="section__head section__head--split">
                <div>
                    <p class="eyebrow"><?php _e('Популярное', 'flowerium'); ?></p>
                    <h2><?php _e('Букеты для быстрой покупки', 'flowerium'); ?></h2>
                </div>
                <a class="text-link" href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>"><?php _e('Весь каталог →', 'flowerium'); ?></a>
            </div>
            <div class="product-grid">
                <?php
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
                
                if ($featured_products->have_posts()) :
                    while ($featured_products->have_posts()) : $featured_products->the_post();
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
                        <button class="button button--small" type="button" data-product-id="<?php echo get_the_ID(); ?>"><?php _e('В корзину', 'flowerium'); ?></button>
                    </article>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p><?php _e('Товары скоро появятся!', 'flowerium'); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="section steps">
            <div class="section__head">
                <p class="eyebrow"><?php _e('Как это работает', 'flowerium'); ?></p>
                <h2><?php _e('От заказа до улыбки получателя', 'flowerium'); ?></h2>
            </div>
            <div class="steps__grid">
                <article>
                    <span>1</span>
                    <h3><?php _e('Выберите букет', 'flowerium'); ?></h3>
                    <p><?php _e('Оформите заказ на сайте или напишите менеджеру.', 'flowerium'); ?></p>
                </article>
                <article>
                    <span>2</span>
                    <h3><?php _e('Согласуем детали', 'flowerium'); ?></h3>
                    <p><?php _e('Уточним адрес, интервал, открытку и способ оплаты.', 'flowerium'); ?></p>
                </article>
                <article>
                    <span>3</span>
                    <h3><?php _e('Соберём и покажем', 'flowerium'); ?></h3>
                    <p><?php _e('Отправим фото готового букета перед доставкой.', 'flowerium'); ?></p>
                </article>
                <article>
                    <span>4</span>
                    <h3><?php _e('Доставим вовремя', 'flowerium'); ?></h3>
                    <p><?php _e('Курьер передаст букет и сообщит о вручении.', 'flowerium'); ?></p>
                </article>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section cta">
            <div>
                <p class="eyebrow"><?php _e('Нужен сайт под WordPress?', 'flowerium'); ?></p>
                <h2><?php _e('Макет готов к переносу в тему или сборке как лендинг', 'flowerium'); ?></h2>
                <p><?php _e('Структура учитывает каталог, формы, российские платежи, CRM, аналитику и будущую смену домена.', 'flowerium'); ?></p>
            </div>
            <a class="button button--primary" href="<?php echo esc_url(get_permalink(get_page_by_path('contacts'))); ?>"><?php _e('Обсудить запуск', 'flowerium'); ?></a>
        </section>

    <?php else : ?>
        
        <!-- Standard Page Content -->
        <div class="page-hero">
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
