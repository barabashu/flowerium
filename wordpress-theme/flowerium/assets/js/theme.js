const floweriumMenuToggle = document.querySelector('[data-menu-toggle]');
const floweriumNav = document.querySelector('[data-nav]');

if (floweriumMenuToggle && floweriumNav) {
  floweriumMenuToggle.addEventListener('click', () => {
    const isOpen = floweriumNav.classList.toggle('is-open');
    floweriumMenuToggle.setAttribute('aria-expanded', String(isOpen));
  });
}
