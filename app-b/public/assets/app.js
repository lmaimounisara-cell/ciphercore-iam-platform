(() => {
  const products = window.BEEHAPPY_PRODUCTS || [];
  const productById = new Map(products.map(p => [p.id, p]));
  const grid = document.getElementById('product-grid');
  const search = document.getElementById('product-search');
  const filters = [...document.querySelectorAll('.filter')];
  let selectedType = 'All';
  let cart = {};

  try {
    const saved = JSON.parse(localStorage.getItem('beehappy-cart') || '{}');
    if (saved && typeof saved === 'object' && !Array.isArray(saved)) {
      cart = Object.fromEntries(Object.entries(saved).filter(([id, qty]) =>
        productById.has(Number(id)) && Number.isInteger(qty) && qty > 0 && qty < 100
      ));
    }
  } catch (_) {}

  const money = n => `${n.toLocaleString('en-US')} MAD`;
  const save = () => {
    localStorage.setItem('beehappy-cart', JSON.stringify(cart));
    renderCart();
  };

  function filterProducts() {
    const query = search.value.trim().toLowerCase();
    let visible = 0;
    grid.querySelectorAll('.product-card').forEach(card => {
      const typeOk = selectedType === 'All' || card.dataset.type === selectedType;
      const searchOk = card.dataset.name.includes(query);
      card.hidden = !(typeOk && searchOk);
      if (!card.hidden) visible++;
    });
    document.getElementById('no-results').hidden = visible !== 0;
  }

  filters.forEach(button => button.addEventListener('click', () => {
    selectedType = button.dataset.type;
    filters.forEach(f => f.classList.toggle('active', f === button));
    filterProducts();
  }));
  search.addEventListener('input', filterProducts);

  document.addEventListener('click', event => {
    const add = event.target.closest('[data-add]');
    if (!add) return;
    const id = Number(add.dataset.add);
    if (!productById.has(id)) return;
    cart[id] = Math.min(99, (cart[id] || 0) + 1);
    save();
    const oldText = add.textContent;
    add.textContent = 'Added';
    setTimeout(() => { add.textContent = oldText; }, 700);
  });

  const drawer = document.getElementById('cart-drawer');
  const backdrop = document.getElementById('cart-backdrop');
  function openCart() {
    backdrop.hidden = false;
    drawer.classList.add('open');
    drawer.setAttribute('aria-hidden', 'false');
  }
  function closeCart() {
    drawer.classList.remove('open');
    drawer.setAttribute('aria-hidden', 'true');
    backdrop.hidden = true;
  }
  document.getElementById('open-cart').addEventListener('click', openCart);
  document.getElementById('close-cart').addEventListener('click', closeCart);
  backdrop.addEventListener('click', closeCart);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCart(); });

  function renderCart() {
    let count = 0, total = 0;
    const container = document.getElementById('cart-items');
    container.replaceChildren();
    Object.entries(cart).forEach(([idText, qty]) => {
      const p = productById.get(Number(idText));
      if (!p) return;
      count += qty;
      total += p.price * qty;
      const row = document.createElement('div');
      row.className = 'cart-row';

      const info = document.createElement('div');
      const title = document.createElement('strong');
      title.textContent = p.name;
      const details = document.createElement('small');
      details.textContent = `${p.weight} · ${money(p.price)} each`;
      info.append(title, details);

      const quantity = document.createElement('div');
      quantity.className = 'quantity';
      const minus = document.createElement('button');
      minus.type = 'button'; minus.textContent = '−'; minus.setAttribute('aria-label', `Remove one ${p.name}`);
      minus.addEventListener('click', () => {
        if (cart[idText] <= 1) delete cart[idText];
        else cart[idText]--;
        save();
      });
      const number = document.createElement('span');
      number.textContent = String(qty);
      const plus = document.createElement('button');
      plus.type = 'button'; plus.textContent = '+'; plus.setAttribute('aria-label', `Add one ${p.name}`);
      plus.addEventListener('click', () => { cart[idText] = Math.min(99, cart[idText] + 1); save(); });
      quantity.append(minus, number, plus);
      row.append(info, quantity);
      container.append(row);
    });
    if (count === 0) {
      const empty = document.createElement('p');
      empty.className = 'empty-cart';
      empty.textContent = 'Your bag is waiting for something sweet.';
      container.append(empty);
    }
    document.getElementById('cart-count').textContent = String(count);
    document.getElementById('drawer-count').textContent = `(${count})`;
    document.getElementById('cart-total').textContent = money(total);
  }
  renderCart();

  document.getElementById('checkout').addEventListener('click', () => {
    alert('This is a portfolio demo. Online checkout and payment processing are not connected yet.');
  });
  document.getElementById('newsletter-form').addEventListener('submit', event => {
    event.preventDefault();
    document.getElementById('newsletter-message').textContent = 'Thanks for your interest! Newsletter signup is a visual demo.';
  });
})();
