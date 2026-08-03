/**
 * Страница успешного заказа success.html
 */

(function() {
  'use strict';

  window.addEventListener('DOMContentLoaded', () => {
    // Получение данных заказа из localStorage или URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderNumberFromUrl = urlParams.get('order');
    const storedOrder = localStorage.getItem('flowerium_last_order');

    let order = null;

    if (storedOrder) {
      try {
        order = JSON.parse(storedOrder);
      } catch (e) {
        order = null;
      }
    }

    // Заполнение номера заказа
    const orderNumberEl = document.getElementById('order-number');
    const displayOrderNumberEl = document.getElementById('display-order-number');
    const orderNumber = order?.number || orderNumberFromUrl || '000';

    if (orderNumberEl) orderNumberEl.textContent = orderNumber;
    if (displayOrderNumberEl) displayOrderNumberEl.textContent = '№ ' + orderNumber;

    // Заполнение даты
    const orderDateEl = document.getElementById('order-date');
    if (orderDateEl && order?.date) {
      const date = new Date(order.date);
      orderDateEl.textContent = date.toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    } else if (orderDateEl) {
      orderDateEl.textContent = new Date().toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });
    }

    // Заполнение суммы
    const orderAmountEl = document.getElementById('order-amount');
    if (orderAmountEl && order?.totals) {
      orderAmountEl.textContent = new Intl.NumberFormat('ru-RU').format(order.totals.total) + ' ₽';
    }

    // Заполнение способа оплаты
    const orderPaymentEl = document.getElementById('order-payment');
    if (orderPaymentEl && order?.customer?.paymentMethod) {
      const paymentMethods = {
        card: 'Банковской картой онлайн',
        sbp: 'СБП (Система быстрых платежей)',
        cash: 'При получении курьеру',
        link: 'Ссылкой на оплату'
      };
      orderPaymentEl.textContent = paymentMethods[order.customer.paymentMethod] || '—';
    }

    // Кнопка "Вернуться в каталог" через некоторое время
    setTimeout(() => {
      const catalogLink = document.createElement('a');
      catalogLink.href = 'catalog.html';
      catalogLink.className = 'button button--ghost';
      catalogLink.style.marginTop = '16px';
      catalogLink.textContent = 'Вернуться в каталог';
      
      const actionsDiv = document.querySelector('.success-actions');
      if (actionsDiv && !actionsDiv.querySelector('.button--ghost')) {
        actionsDiv.appendChild(catalogLink);
      }
    }, 3000);
  });

})();
