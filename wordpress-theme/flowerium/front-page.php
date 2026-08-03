<?php
/**
 * Front page template.
 *
 * @package Flowerium
 */
get_header();
?>
<main>
    <section class="hero section-grid">
        <div class="hero__content">
            <p class="eyebrow"><?php esc_html_e('Свежие цветы каждый день', 'flowerium'); ?></p>
            <h1><?php esc_html_e('Букеты, которые доставляют эмоции', 'flowerium'); ?></h1>
            <p class="hero__lead"><?php esc_html_e('Собираем авторские композиции, присылаем фото перед отправкой и доставляем по городу в удобный интервал.', 'flowerium'); ?></p>
            <div class="hero__actions">
                <a class="button button--primary" href="<?php echo esc_url(home_url('/catalog/')); ?>"><?php esc_html_e('Выбрать букет', 'flowerium'); ?></a>
                <a class="button button--ghost" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Заказать консультацию', 'flowerium'); ?></a>
            </div>
            <ul class="hero__facts" aria-label="<?php esc_attr_e('Преимущества', 'flowerium'); ?>">
                <li><strong>60 мин</strong><span><?php esc_html_e('срочная сборка', 'flowerium'); ?></span></li>
                <li><strong>4.9/5</strong><span><?php esc_html_e('оценка клиентов', 'flowerium'); ?></span></li>
                <li><strong><?php esc_html_e('Фото', 'flowerium'); ?></strong><span><?php esc_html_e('перед доставкой', 'flowerium'); ?></span></li>
            </ul>
        </div>
        <div class="hero__card" aria-label="<?php esc_attr_e('Пример букета', 'flowerium'); ?>">
            <img src="<?php echo flowerium_asset('img/hero-bouquet.svg'); ?>" alt="<?php esc_attr_e('Нежный букет Flowerium', 'flowerium'); ?>">
            <div class="hero__price"><span><?php esc_html_e('Хит недели', 'flowerium'); ?></span><strong><?php esc_html_e('от 3 900 ₽', 'flowerium'); ?></strong></div>
        </div>
    </section>

    <section class="section">
        <div class="section__head"><p class="eyebrow"><?php esc_html_e('Категории', 'flowerium'); ?></p><h2><?php esc_html_e('Подберите букет под повод', 'flowerium'); ?></h2></div>
        <div class="category-grid">
            <article class="category-card"><span>🌹</span><h3><?php esc_html_e('Розы', 'flowerium'); ?></h3><p><?php esc_html_e('Классика для свидания, юбилея и признания.', 'flowerium'); ?></p></article>
            <article class="category-card"><span>💐</span><h3><?php esc_html_e('Сборные букеты', 'flowerium'); ?></h3><p><?php esc_html_e('Авторские сочетания сезонных цветов.', 'flowerium'); ?></p></article>
            <article class="category-card"><span>🎁</span><h3><?php esc_html_e('Цветы в коробке', 'flowerium'); ?></h3><p><?php esc_html_e('Эффектная подача и удобная доставка.', 'flowerium'); ?></p></article>
            <article class="category-card"><span>🏢</span><h3><?php esc_html_e('Корпоративные', 'flowerium'); ?></h3><p><?php esc_html_e('Композиции для клиентов, офиса и мероприятий.', 'flowerium'); ?></p></article>
        </div>
    </section>

    <?php get_template_part('template-parts/product-preview'); ?>
    <?php get_template_part('template-parts/order-steps'); ?>

    <section class="section cta">
        <div><p class="eyebrow"><?php esc_html_e('Готово к WordPress', 'flowerium'); ?></p><h2><?php esc_html_e('Тема уже содержит обязательную таблицу стилей', 'flowerium'); ?></h2><p><?php esc_html_e('Можно устанавливать папку flowerium как полноценную тему и дорабатывать каталог через WooCommerce.', 'flowerium'); ?></p></div>
        <a class="button button--primary" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Обсудить запуск', 'flowerium'); ?></a>
    </section>
</main>
<?php get_footer(); ?>
