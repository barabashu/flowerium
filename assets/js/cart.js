/**
 * Корзина покупок для Flowerium
 * Хранение данных в localStorage, управление товарами и подсчёт итогов
 */

(function() {
  'use strict';

  const CART_KEY = 'flowerium_cart';
  const DELIVERY_COST = 390;

  // Инициализация корзины
  function getCart() {
    try {
      return JSON.parse(localStorage.getItem(CART_KEY)) || [];
    } catch (e) {
      return [];
    }
  }

  function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
    updateCartCount();
  }

  // Добавление товара
  function addToCart(product) {
    const cart = getCart();
    const existingIndex = cart.findIndex(item => item.id === product.id);

    if (existingIndex > -1) {
      cart[existingIndex].quantity += 1;
    } else {
      cart.push({ ...product, quantity: 1 });
    }

    saveCart(cart);
    renderCart();
    showNotification('Товар добавлен в корзину');
  }

  // Удаление товара
  function removeFromCart(productId) {
    const cart = getCart().filter(item => item.id !== productId);
    saveCart(cart);
    renderCart();
  }

  // Изменение количества
  function updateQuantity(productId, delta) {
    const cart = getCart();
    const item = cart.find(i => i.id === productId);

    if (!item) return;

    item.quantity += delta;

    if (item.quantity <= 0) {
      removeFromCart(productId);
      return;
    }

    saveCart(cart);
    renderCart();
  }

  // Очистка корзины
  function clearCart() {
    localStorage.removeItem(CART_KEY);
    updateCartCount();
    renderCart();
  }

  // Подсчёт итогов
  function getTotals() {
    const cart = getCart();
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const delivery = subtotal > 0 ? DELIVERY_COST : 0;
    const total = subtotal + delivery;

    return { subtotal, delivery, total };
  }

  // Обновление счётчика в шапке
  function updateCartCount() {
    const cart = getCart();
    const countElements = document.querySelectorAll('[data-cart-count]');
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);

    countElements.forEach(el => {
      el.textContent = totalCount;
      el.style.display = totalCount > 0 ? 'inline-block' : 'none';
    });
  }

  // Рендер корзины на странице cart.html
  function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    if (!cartItemsContainer) return;

    const cart = getCart();
    const totals = getTotals();

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = `
        <div class="cart-empty">
          <h2>Корзина пуста</h2>
          <p>Выберите букеты в каталоге, чтобы оформить заказ.</p>
          <a class="button button--primary" href="catalog.html">Перейти в каталог</a>
        </div>
      `;
    } else {
      cartItemsContainer.innerHTML = `
        <h2 style="margin-bottom: 24px;">Товары в корзине (${cart.length})</h2>
        ${cart.map(item => `
          <article class="cart-item">
            <img src="${item.image || '../assets/img/bouquet-rose.svg'}" alt="${item.name}">
            <div class="cart-item__info">
              <h3>${item.name}</h3>
              <p class="cart-item__composition">${item.composition || ''}</p>
              <p class="cart-item__price">${formatPrice(item.price)}</p>
            </div>
            <div class="cart-item__quantity">
              <button type="button" class="qty-btn" data-action="decrease" data-id="${item.id}">−</button>
              <span>${item.quantity}</span>
              <button type="button" class="qty-btn" data-action="increase" data-id="${item.id}">+</button>
            </div>
            <p class="cart-item__total">${formatPrice(item.price * item.quantity)}</p>
            <button type="button" class="cart-item__remove" data-action="remove" data-id="${item.id}">×</button>
          </article>
        `).join('')}
      `;

      // Обработчики кнопок
      cartItemsContainer.querySelectorAll('[data-action]').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const action = e.target.dataset.action;
          const id = parseInt(e.target.dataset.id);

          if (action === 'increase') updateQuantity(id, 1);
          else if (action === 'decrease') updateQuantity(id, -1);
          else if (action === 'remove') removeFromCart(id);
        });
      });
    }

    // Обновление итогов
    const subtotalEl = document.querySelector('[data-cart-subtotal]');
    const deliveryEl = document.querySelector('[data-cart-delivery]');
    const totalEl = document.querySelector('[data-cart-total]');

    if (subtotalEl) subtotalEl.textContent = formatPrice(totals.subtotal);
    if (deliveryEl) deliveryEl.textContent = totals.delivery > 0 ? formatPrice(totals.delivery) : '—';
    if (totalEl) totalEl.textContent = formatPrice(totals.total);
  }

  // Рендер заказа на checkout.html
  function renderOrderSummary() {
    const orderItemsContainer = document.getElementById('order-items');
    if (!orderItemsContainer) return;

    const cart = getCart();
    const totals = getTotals();

    if (cart.length === 0) {
      window.location.href = 'cart.html';
      return;
    }

    orderItemsContainer.innerHTML = cart.map(item => `
      <div class="order-item">
        <span class="order-item__name">${item.name}</span>
        <span class="order-item__qty">× ${item.quantity}</span>
        <span class="order-item__price">${formatPrice(item.price * item.quantity)}</span>
      </div>
    `).join('');

    const subtotalEl = document.querySelector('[data-order-subtotal]');
    const deliveryEl = document.querySelector('[data-order-delivery]');
    const totalEl = document.querySelector('[data-order-total]');

    if (subtotalEl) subtotalEl.textContent = formatPrice(totals.subtotal);
    if (deliveryEl) deliveryEl.textContent = formatPrice(totals.delivery);
    if (totalEl) totalEl.textContent = formatPrice(totals.total);
  }

  // Форматирование цены
  function formatPrice(price) {
    return new Intl.NumberFormat('ru-RU').format(price) + ' ₽';
  }

  // Уведомление
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #2a1b1f;
      color: white;
      padding: 16px 24px;
      border-radius: 16px;
      box-shadow: 0 16px 45px rgba(130, 51, 74, 0.15);
      z-index: 1000;
      animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.animation = 'slideOut 0.3s ease';
      setTimeout(() => notification.remove(), 300);
    }, 2500);
  }

  // Экспорт функций для глобального доступа
  window.FloweriumCart = {
    addToCart,
    removeFromCart,
    updateQuantity,
    clearCart,
    getCart,
    getTotals,
    renderCart,
    renderOrderSummary
  };

  // Инициализация при загрузке
  document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderCart();
    renderOrderSummary();

    // Навешиваем обработчики на кнопки "В корзину"
    document.querySelectorAll('.product-card .button').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const card = e.target.closest('.product-card');
        if (!card) return;

        const name = card.querySelector('h3')?.textContent || 'Букет';
        const priceText = card.querySelector('strong')?.textContent || '0 ₽';
        const price = parseInt(priceText.replace(/\D/g, ''));
        const image = card.querySelector('img')?.src || '';
        const composition = card.querySelector('p')?.textContent || '';

        const product = {
          id: Date.now(),
          name,
          price,
          image,
          composition
        };

        addToCart(product);
      });
    });
  });

  // Добавляем CSS анимации для уведомлений
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideIn {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
      from { transform: translateX(0); opacity: 1; }
      to { transform: translateX(100%); opacity: 0; }
    }
  `;
  document.head.appendChild(style);

})();
