<?php
/**
 * The template for displaying contact page with map and form
 * Template Name: Контакты
 *
 * @package Flowerium_Complete
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <section class="contacts-section">
        <div class="container">
            <div class="contacts-wrapper">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h2><?php _e('Наши контакты', 'flowerium-complete'); ?></h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4><?php _e('Адрес', 'flowerium-complete'); ?></h4>
                            <p><?php echo esc_html(flowerium_get_address()); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4><?php _e('Телефон', 'flowerium-complete'); ?></h4>
                            <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', flowerium_get_phone())); ?>"><?php echo esc_html(flowerium_get_phone()); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4><?php _e('Email', 'flowerium-complete'); ?></h4>
                            <p><a href="mailto:<?php echo esc_attr(flowerium_get_email()); ?>"><?php echo esc_html(flowerium_get_email()); ?></a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4><?php _e('Режим работы', 'flowerium-complete'); ?></h4>
                            <p><?php echo esc_html(flowerium_get_hours()); ?></p>
                        </div>
                    </div>
                    
                    <div class="social-links" style="margin-top: 30px;">
                        <?php if (flowerium_get_instagram()) : ?>
                            <a href="<?php echo esc_url(flowerium_get_instagram()); ?>" class="social-link" target="_blank" rel="noopener">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (flowerium_get_vk()) : ?>
                            <a href="<?php echo esc_url(flowerium_get_vk()); ?>" class="social-link" target="_blank" rel="noopener">
                                <i class="fab fa-vk"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (flowerium_get_telegram()) : ?>
                            <a href="<?php echo esc_url(flowerium_get_telegram()); ?>" class="social-link" target="_blank" rel="noopener">
                                <i class="fab fa-telegram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (flowerium_get_whatsapp()) : ?>
                            <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', flowerium_get_whatsapp())); ?>" class="social-link" target="_blank" rel="noopener">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <h2><?php _e('Напишите нам', 'flowerium-complete'); ?></h2>
                    <?php
                    // Check if Contact Form 7 is active
                    if (function_exists('contact_form_7')) {
                        echo do_shortcode('[contact-form-7 id="contact-form" title="Контактная форма"]');
                    } else {
                        ?>
                        <form class="contact-form" method="post" action="">
                            <div class="form-group">
                                <label for="contact-name"><?php _e('Ваше имя', 'flowerium-complete'); ?> *</label>
                                <input type="text" id="contact-name" name="contact_name" required />
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-email"><?php _e('Email', 'flowerium-complete'); ?> *</label>
                                <input type="email" id="contact-email" name="contact_email" required />
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-phone"><?php _e('Телефон', 'flowerium-complete'); ?></label>
                                <input type="tel" id="contact-phone" name="contact_phone" />
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-message"><?php _e('Сообщение', 'flowerium-complete'); ?> *</label>
                                <textarea id="contact-message" name="contact_message" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> <?php _e('Отправить', 'flowerium-complete'); ?>
                            </button>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section" style="padding: var(--spacing-xl) 0;">
        <div class="container">
            <div class="section-title">
                <h2><?php _e('Наши магазины в Крыму', 'flowerium-complete'); ?></h2>
            </div>
            
            <div class="map-wrapper" style="height: 500px; border-radius: var(--border-radius); overflow: hidden; box-shadow: var(--box-shadow);">
                <!-- Yandex Map placeholder - replace with actual map code -->
                <div id="yandex-map" style="width: 100%; height: 100%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <div style="text-align: center; padding: 40px;">
                        <i class="fas fa-map-marked-alt" style="font-size: 4rem; color: var(--color-primary); margin-bottom: 20px;"></i>
                        <h3><?php _e('Интерактивная карта', 'flowerium-complete'); ?></h3>
                        <p><?php _e('Для отображения карты необходимо подключить Яндекс.Карты API', 'flowerium-complete'); ?></p>
                        <p style="font-size: 0.875rem; color: var(--color-text-light); margin-top: 10px;">
                            <?php _e('Симферополь, Ялта, Севастополь, Евпатория, Феодосия, Алушта', 'flowerium-complete'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
