<?php
/**
 * Front page template
 *
 * @package Flowerium
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1><?php _e('Свежие цветы с доставкой по Крыму', 'flowerium'); ?></h1>
            <p><?php _e('Авторские букеты, композиции и подарки для ваших близких. Доставка за 2 часа!', 'flowerium'); ?></p>
            <?php if (class_exists('WooCommerce')) : ?>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary">
                    <?php _e('Перейти в каталог', 'flowerium'); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section mt-3">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h3><?php _e('Быстрая доставка', 'flowerium'); ?></h3>
                    <p><?php _e('Доставим букет за 2 часа по любому городу Крыма', 'flowerium'); ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌸</div>
                    <h3><?php _e('Свежие цветы', 'flowerium'); ?></h3>
                    <p><?php _e('Только свежие цветы от лучших поставщиков', 'flowerium'); ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎁</div>
                    <h3><?php _e('Подарки', 'flowerium'); ?></h3>
                    <p><?php _e('Дополнительные подарки к каждому заказу', 'flowerium'); ?></p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3><?php _e('Удобная оплата', 'flowerium'); ?></h3>
                    <p><?php _e('Оплата картой, наличными или онлайн', 'flowerium'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <?php if (class_exists('WooCommerce')) : ?>
    <section class="products-section mt-3">
        <div class="container">
            <h2 class="text-center mb-2"><?php _e('Популярные букеты', 'flowerium'); ?></h2>
            
            <?php
            echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]');
            ?>
            
            <div class="text-center mt-2">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-outline">
                    <?php _e('Смотреть весь каталог', 'flowerium'); ?>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Cities Section -->
    <section class="cities-section mt-3">
        <div class="container text-center">
            <h2 class="mb-2"><?php _e('Доставка по Крыму', 'flowerium'); ?></h2>
            <p class="mb-2"><?php _e('Мы осуществляем доставку цветов в следующие города:', 'flowerium'); ?></p>
            <div class="cities-list">
                <span>📍 Симферополь</span>
                <span>📍 Ялта</span>
                <span>📍 Севастополь</span>
                <span>📍 Евпатория</span>
                <span>📍 Феодосия</span>
                <span>📍 Керчь</span>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section mt-3">
        <div class="container text-center">
            <h2><?php _e('Нужна помощь с выбором?', 'flowerium'); ?></h2>
            <p><?php _e('Наши флористы помогут подобрать идеальный букет', 'flowerium'); ?></p>
            <a href="tel:+79780000000" class="btn btn-secondary">
                <?php _e('Позвонить нам', 'flowerium'); ?>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
