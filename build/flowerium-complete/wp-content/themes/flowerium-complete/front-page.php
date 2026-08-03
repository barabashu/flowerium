<?php
/**
 * The main template file
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <?php if (is_front_page()) : ?>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1><?php _e('Свежие цветы с доставкой по Крыму', 'flowerium-complete'); ?></h1>
                    <p><?php _e('Авторские букеты от лучших флористов полуострова. Доставка в день заказа.', 'flowerium-complete'); ?></p>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="btn btn-primary"><?php _e('Перейти в каталог', 'flowerium-complete'); ?></a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="section-title">
                <h2><?php _e('Популярные букеты', 'flowerium-complete'); ?></h2>
            </div>
            
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
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
                echo '<div class="products-grid">';
                while ($featured_products->have_posts()) :
                    $featured_products->the_post();
                    global $product;
                    ?>
                    <div class="product-card">
                        <?php if ($product->is_featured()) : ?>
                            <span class="product-badge"><?php _e('Хит', 'flowerium-complete'); ?></span>
                        <?php endif; ?>
                        
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo $product->get_image('flowerium-product'); ?>
                            </a>
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <div class="product-price">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            
                            <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                                <button class="btn btn-primary product-add-to-cart" 
                                        data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                    <i class="fas fa-shopping-cart"></i>
                                    <?php _e('В корзину', 'flowerium-complete'); ?>
                                </button>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline">
                                    <?php _e('Подробнее', 'flowerium-complete'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                ?>
                <p><?php _e('Товары временно отсутствуют.', 'flowerium-complete'); ?></p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('catalog'))); ?>" class="btn btn-primary">
                    <?php _e('Перейти в каталог', 'flowerium-complete'); ?>
                </a>
                <?php
            endif;
            ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3><?php _e('Быстрая доставка', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Доставим букет в течение 2 часов по Симферополю и в день заказа по всему Крыму', 'flowerium-complete'); ?></p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3><?php _e('Свежие цветы', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Работаем только со свежими цветами, которые поставляем напрямую из теплиц', 'flowerium-complete'); ?></p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3><?php _e('Подарок к заказу', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Бесплатно добавим открытку и упаковку для каждого букета', 'flowerium-complete'); ?></p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3><?php _e('Удобная оплата', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Оплачивайте онлайн картой или наличными при получении', 'flowerium-complete'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2><?php _e('О сети Flowerium', 'flowerium-complete'); ?></h2>
                    <p><?php _e('Мы — команда профессиональных флористов, которая уже более 5 лет радует жителей Крыма красивыми букетами. Наши салоны расположены в Симферополе, Ялте, Севастополе, Евпатории, Феодосии и Алуште.', 'flowerium-complete'); ?></p>
                    <p><?php _e('Каждый день мы создаем уникальные композиции, используя только свежие цветы высшего качества. Мы верим, что цветы могут сделать мир лучше, и стремимся дарить эту красоту каждому нашему клиенту.', 'flowerium-complete'); ?></p>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn-outline">
                        <?php _e('Узнать больше', 'flowerium-complete'); ?>
                    </a>
                </div>
                <div class="about-image">
                    <img src="<?php echo FLOWERIUM_URI; ?>/assets/images/about.jpg" alt="<?php _e('О компании Flowerium', 'flowerium-complete'); ?>" />
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery Info Section -->
    <section class="delivery-section">
        <div class="container">
            <div class="section-title">
                <h2><?php _e('Доставка по Крыму', 'flowerium-complete'); ?></h2>
            </div>
            
            <div class="delivery-grid">
                <div class="delivery-card">
                    <h3><i class="fas fa-city"></i> <?php _e('Симферополь', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Бесплатная доставка при заказе от 3000 ₽', 'flowerium-complete'); ?></p>
                    <div class="delivery-zones">
                        <div class="zone-item">
                            <span><?php _e('Центр', 'flowerium-complete'); ?></span>
                            <span><?php _e('2 часа', 'flowerium-complete'); ?></span>
                        </div>
                        <div class="zone-item">
                            <span><?php _e('Отдаленные районы', 'flowerium-complete'); ?></span>
                            <span><?php _e('4-6 часов', 'flowerium-complete'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="delivery-card">
                    <h3><i class="fas fa-umbrella-beach"></i> <?php _e('Южный берег', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Ялта, Алушта, Гурзуф', 'flowerium-complete'); ?></p>
                    <div class="delivery-zones">
                        <div class="zone-item">
                            <span><?php _e('Стоимость', 'flowerium-complete'); ?></span>
                            <span><?php _e('от 500 ₽', 'flowerium-complete'); ?></span>
                        </div>
                        <div class="zone-item">
                            <span><?php _e('Срок', 'flowerium-complete'); ?></span>
                            <span><?php _e('в день заказа', 'flowerium-complete'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="delivery-card">
                    <h3><i class="fas fa-anchor"></i> <?php _e('Западный Крым', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Евпатория, Саки, Черноморское', 'flowerium-complete'); ?></p>
                    <div class="delivery-zones">
                        <div class="zone-item">
                            <span><?php _e('Стоимость', 'flowerium-complete'); ?></span>
                            <span><?php _e('от 700 ₽', 'flowerium-complete'); ?></span>
                        </div>
                        <div class="zone-item">
                            <span><?php _e('Срок', 'flowerium-complete'); ?></span>
                            <span><?php _e('1-2 дня', 'flowerium-complete'); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="delivery-card">
                    <h3><i class="fas fa-sun"></i> <?php _e('Восточный Крым', 'flowerium-complete'); ?></h3>
                    <p><?php _e('Феодосия, Судак, Коктебель', 'flowerium-complete'); ?></p>
                    <div class="delivery-zones">
                        <div class="zone-item">
                            <span><?php _e('Стоимость', 'flowerium-complete'); ?></span>
                            <span><?php _e('от 800 ₽', 'flowerium-complete'); ?></span>
                        </div>
                        <div class="zone-item">
                            <span><?php _e('Срок', 'flowerium-complete'); ?></span>
                            <span><?php _e('1-2 дня', 'flowerium-complete'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('delivery'))); ?>" class="btn btn-primary">
                    <?php _e('Подробнее о доставке', 'flowerium-complete'); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
