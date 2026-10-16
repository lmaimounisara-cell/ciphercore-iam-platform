<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/auth.php';

$customer = $_SESSION['app_b_user']['name'] ?? null;

$products = [
    ['id'=>1, 'name'=>'Euphorbia Honey', 'ar'=>'عسل الدغموس', 'type'=>'Wild & Rare', 'price'=>180, 'weight'=>'250 g', 'image'=>'photo-1587049352851-8d4e89133924', 'tag'=>'Rare find', 'tone'=>'amber'],
    ['id'=>2, 'name'=>'Orange Blossom', 'ar'=>'عسل زهر البرتقال', 'type'=>'Floral', 'price'=>120, 'weight'=>'250 g', 'image'=>'photo-1471943311424-646960669fbc', 'tag'=>'Best seller', 'tone'=>'cream'],
    ['id'=>3, 'name'=>'Thyme Honey', 'ar'=>'عسل الزعتر', 'type'=>'Wild & Rare', 'price'=>160, 'weight'=>'250 g', 'image'=>'photo-1587049352851-8d4e89133924', 'tag'=>'Artisan pick', 'tone'=>'green'],
    ['id'=>4, 'name'=>'Mountain Honey', 'ar'=>'عسل الجبال', 'type'=>'Mountain', 'price'=>145, 'weight'=>'250 g', 'image'=>'photo-1471943311424-646960669fbc', 'tag'=>'Pure & natural', 'tone'=>'amber'],
    ['id'=>5, 'name'=>'Acacia Honey', 'ar'=>'عسل الأكاسيا', 'type'=>'Floral', 'price'=>135, 'weight'=>'250 g', 'image'=>'photo-1587049352851-8d4e89133924', 'tag'=>'Light & delicate', 'tone'=>'cream'],
    ['id'=>6, 'name'=>'Honey Gift Set', 'ar'=>'علبة هدايا', 'type'=>'Gift sets', 'price'=>320, 'weight'=>'3 mini jars', 'image'=>'photo-1471943311424-646960669fbc', 'tag'=>'Made for gifting', 'tone'=>'green'],
];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#fbf8f0">
<title>BeeHappy — A little taste of nature</title>
<link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="announcement">A LITTLE GOLDEN GOODNESS, DELIVERED TO YOUR DOOR</div>

<header class="site-header">
  <a class="brand" href="/" aria-label="BeeHappy home">
    <span class="brand-mark">b<span>.</span></span>
    <span><strong>BeeHappy</strong><small>HONEY & NATURAL GOODNESS</small></span>
  </a>
  <nav class="main-nav" aria-label="Main navigation">
    <a href="#shop">Shop honey</a>
    <a href="#story">Our story</a>
    <a href="#promise">Our promise</a>
  </nav>
  <div class="header-actions">
    <?php if ($customer): ?>
      <a class="account-link" href="/dashboard.php">Hi, <?= htmlspecialchars((string)$customer, ENT_QUOTES, 'UTF-8') ?></a>
      <a class="account-link" href="/logout.php">Sign out</a>
    <?php else: ?>
      <a class="account-link" href="/login.php">Sign in</a>
    <?php endif; ?>
    <button class="cart-button" id="open-cart" type="button" aria-label="Open shopping cart">
      Bag <span id="cart-count">0</span>
    </button>
  </div>
</header>

<main>
<section class="hero">
  <div class="hero-copy">
    <span class="eyebrow"><span class="tiny-bee">✳</span> FROM NATURE, WITH LOVE</span>
    <h1>A little jar of<br><em>golden happiness.</em></h1>
    <p>Discover beautiful honey, gathered with care and chosen for the little moments that make life sweeter.</p>
    <div class="hero-actions">
      <a class="button button-dark" href="#shop">Explore our honey <span>↗</span></a>
      <a class="text-link" href="#story">Get to know us</a>
    </div>
    <div class="hero-note"><span class="note-star">✳</span><span><strong>Nature's finest.</strong><br>Simply honey, nothing unnecessary.</span></div>
  </div>
  <div class="hero-visual">
    <div class="sun-disc"></div>
    <div class="hero-label">A SWEETER<br>KIND OF EVERYDAY</div>
    <img class="hero-photo" src="https://images.unsplash.com/photo-1587049352851-8d4e89133924?auto=format&fit=crop&w=1100&q=85" alt="Golden honey in a glass jar">
    <div class="floating-note"><span class="honey-dot"></span> A golden drop of nature</div>
    <span class="decor decor-one">✳</span><span class="decor decor-two">✳</span>
  </div>
</section>

<section class="trust-strip" id="promise">
  <div><span class="trust-icon">✳</span><span><strong>Nature inspired</strong><small>Thoughtfully selected</small></span></div>
  <div><span class="trust-icon">◇</span><span><strong>Small-batch feel</strong><small>Care in every jar</small></span></div>
  <div><span class="trust-icon">♡</span><span><strong>Made for sharing</strong><small>Goodness worth gifting</small></span></div>
</section>

<section class="shop-section" id="shop">
  <div class="section-heading">
    <div><span class="eyebrow">THE BEEHAPPY COLLECTION</span><h2>Find your kind of <em>sweet.</em></h2></div>
    <p>From delicate floral notes to bold mountain flavours, there's a jar for every table.</p>
  </div>

  <div class="shop-tools">
    <div class="filter-list" id="filters">
      <button class="filter active" data-type="All">All honey</button>
      <button class="filter" data-type="Floral">Floral</button>
      <button class="filter" data-type="Mountain">Mountain</button>
      <button class="filter" data-type="Wild & Rare">Wild &amp; rare</button>
      <button class="filter" data-type="Gift sets">Gift sets</button>
    </div>
    <label class="search-box"><span>⌕</span><input id="product-search" type="search" placeholder="Find your favourite..." aria-label="Search honey products"></label>
  </div>

  <div class="product-grid" id="product-grid">
    <?php foreach ($products as $p): ?>
    <article class="product-card" data-type="<?= htmlspecialchars($p['type'], ENT_QUOTES, 'UTF-8') ?>" data-name="<?= htmlspecialchars(strtolower($p['name'].' '.$p['ar'].' '.$p['type']), ENT_QUOTES, 'UTF-8') ?>">
      <div class="product-image <?= htmlspecialchars($p['tone'], ENT_QUOTES, 'UTF-8') ?>">
        <img loading="lazy" src="https://images.unsplash.com/<?= htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') ?>?auto=format&fit=crop&w=700&q=80" alt="<?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>">
        <span class="product-tag"><?= htmlspecialchars($p['tag'], ENT_QUOTES, 'UTF-8') ?></span>
        <button class="quick-add" type="button" data-add="<?= (int)$p['id'] ?>" aria-label="Add <?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?> to bag">+</button>
      </div>
      <div class="product-meta"><span><?= htmlspecialchars($p['type'], ENT_QUOTES, 'UTF-8') ?></span><span><?= htmlspecialchars($p['weight'], ENT_QUOTES, 'UTF-8') ?></span></div>
      <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
      <div class="arabic-name" lang="ar" dir="rtl"><?= htmlspecialchars($p['ar'], ENT_QUOTES, 'UTF-8') ?></div>
      <div class="product-bottom"><strong><?= number_format($p['price'], 0) ?> MAD</strong><button type="button" class="add-link" data-add="<?= (int)$p['id'] ?>">Add to bag +</button></div>
    </article>
    <?php endforeach; ?>
  </div>
  <p id="no-results" class="no-results" hidden>No honey found. Try another search.</p>
</section>

<section class="story-section" id="story">
  <div class="story-image"><img src="https://images.unsplash.com/photo-1471943311424-646960669fbc?auto=format&fit=crop&w=1000&q=85" loading="lazy" alt="Honey and natural ingredients on a wooden table"></div>
  <div class="story-copy"><span class="eyebrow">A SWEETER WAY OF LIVING</span><h2>Good things take<br><em>a little care.</em></h2><p>BeeHappy is a honey-store concept inspired by nature, local flavours and the simple joy of sharing something good. Explore our collection and discover a new favourite for your morning toast, afternoon tea or thoughtful gift.</p><a class="button button-dark" href="#shop">Discover the collection <span>↗</span></a></div>
</section>

<section class="newsletter">
  <span class="eyebrow">A LITTLE NOTE FROM THE HIVE</span>
  <h2>Stay on the <em>sweet side.</em></h2>
  <p>More honey inspiration, seasonal picks and gift ideas.</p>
  <form id="newsletter-form"><input type="email" placeholder="Your email address" aria-label="Email address" required><button class="button button-dark" type="submit">Count me in ↗</button></form>
  <small id="newsletter-message">Demo form — no email will be sent.</small>
</section>
</main>

<footer class="footer">
  <a class="brand" href="/"><span class="brand-mark">b<span>.</span></span><span><strong>BeeHappy</strong><small>HONEY & NATURAL GOODNESS</small></span></a>
  <span>Made for the love of honey.</span>
  <span>© <?= date('Y') ?> BeeHappy · Demo storefront</span>
</footer>

<div class="cart-backdrop" id="cart-backdrop" hidden></div>
<aside class="cart-drawer" id="cart-drawer" aria-label="Shopping cart" aria-hidden="true">
  <div class="cart-head"><div><span class="eyebrow">YOUR LITTLE TREASURES</span><h2>Your bag <span id="drawer-count">(0)</span></h2></div><button id="close-cart" class="close-cart" aria-label="Close cart">×</button></div>
  <div id="cart-items" class="cart-items"><p class="empty-cart">Your bag is waiting for something sweet.</p></div>
  <div class="cart-footer"><div class="cart-total"><span>Subtotal</span><strong id="cart-total">0 MAD</strong></div><button class="button button-dark checkout-button" id="checkout" type="button">Continue to checkout ↗</button><small>Demo only. Checkout and payment are not connected.</small></div>
</aside>
<script>
window.BEEHAPPY_PRODUCTS = <?= json_encode(array_map(static fn($p) => ['id'=>$p['id'],'name'=>$p['name'],'price'=>$p['price'],'weight'=>$p['weight']], $products), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
</script>
<script src="/assets/app.js"></script>
</body>
</html>
