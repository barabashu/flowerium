/**
 * Обработка оформления заказа на checkout.html
 */

(function() {
  'use strict';

  const form = document.getElementById('checkout-form');
  if (!form) return;

  // Показ/скрытие полей плательщика
  const sameAsRecipientCheckbox = form.querySelector('[name="sameAsRecipient"]');
  const payerFields = document.getElementById('payer-fields');

  if (sameAsRecipientCheckbox && payerFields) {
    sameAsRecipientCheckbox.addEventListener('change', () => {
      payerFields.style.display = sameAsRecipientCheckbox.checked ? 'none' : 'block';
    });
  }

  // Установка минимальной даты доставки (сегодня)
  const dateInput = form.querySelector('[name="deliveryDate"]');
  if (dateInput) {
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
    dateInput.value = today;
  }

  // Обработка отправки формы
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Сбор данных формы
    const formData = new FormData(form);
    const orderData = Object.fromEntries(formData.entries());

    // Получение данных корзины
    const cart = window.FloweriumCart?.getCart() || [];
    const totals = window.FloweriumCart?.getTotals() || { total: 0 };

    if (cart.length === 0) {
      alert('Корзина пуста. Добавьте товары перед оформлением заказа.');
      return;
    }

    if (!orderData.consent) {
      alert('Необходимо согласие на обработку персональных данных.');
      return;
    }

    // Генерация номера заказа
    const orderNumber = Math.floor(1000 + Math.random() * 9000);

    // Сохранение заказа в localStorage для страницы успеха
    const order = {
      number: orderNumber,
      date: new Date().toISOString(),
      items: cart,
      totals,
      customer: {
        recipientName: orderData.recipientName,
        recipientPhone: orderData.recipientPhone,
        city: orderData.city,
        address: orderData.address,
        entrance: orderData.entrance,
        floor: orderData.floor,
        intercom: orderData.intercom,
        deliveryDate: orderData.deliveryDate,
        deliveryTime: orderData.deliveryTime,
        comment: orderData.comment,
        payerName: orderData.payerName || orderData.recipientName,
        payerEmail: orderData.payerEmail,
        paymentMethod: orderData.paymentMethod,
        cardText: orderData.cardText,
        noCall: !!orderData.noCall,
        photoConfirm: !!orderData.photoConfirm
      }
    };

    localStorage.setItem('flowerium_last_order', JSON.stringify(order));

    // Очистка корзины
    window.FloweriumCart?.clearCart();

    // Переход на страницу успеха
    window.location.href = 'success.html?order=' + orderNumber;
  });

  // Предзаполнение данных при возврате на страницу
  window.addEventListener('DOMContentLoaded', () => {
    renderOrderSummary();
  });

})();
