<?php
require_once 'config/bootstrap.php';
$produkModel = new Produk($conn);
$produkList  = $produkModel->all();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toko Buah Segar — Buah Segar dari Kebun Terbaik</title>
  <meta name="description" content="Toko buah segar online. Dipetik langsung dari kebun terbaik untuk keluarga Anda.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- ══ NAVBAR ══ -->
<nav class="navbar">
  <a href="index.php" class="navbar-brand">
    <div class="brand-leaf">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
      </svg>
    </div>
    Toko Buah Segar
  </a>
  <div class="navbar-links">
    <a href="index.php">Beranda</a>
    <a href="login.php" class="btn-masuk">Masuk Admin</a>
  </div>
</nav>

<!-- ══ HERO ══ -->
<section class="hero fade-up">
  <!-- Pola daun SVG sebagai background -->
  <svg class="hero-leaf-pattern" viewBox="0 0 1200 340" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice">
    <g fill="none" stroke="#5a8a3c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <!-- Baris atas: daun-daun besar -->
      <g transform="translate(60,30)"><ellipse cx="0" cy="0" rx="28" ry="12" transform="rotate(-35)"/><ellipse cx="0" cy="0" rx="28" ry="12" transform="rotate(25)"/><line x1="0" y1="0" x2="0" y2="40" stroke-width="1.8"/></g>
      <g transform="translate(160,18)"><ellipse cx="0" cy="0" rx="22" ry="10" transform="rotate(-28)"/><ellipse cx="0" cy="0" rx="22" ry="10" transform="rotate(30)"/><line x1="0" y1="0" x2="0" y2="32" stroke-width="1.5"/></g>
      <g transform="translate(270,35)"><ellipse cx="0" cy="0" rx="26" ry="11" transform="rotate(-32)"/><ellipse cx="0" cy="0" rx="26" ry="11" transform="rotate(22)"/><line x1="0" y1="0" x2="0" y2="38" stroke-width="1.6"/></g>
      <g transform="translate(390,14)"><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(-20)"/><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(36)"/><line x1="0" y1="0" x2="0" y2="28" stroke-width="1.4"/></g>
      <g transform="translate(500,28)"><ellipse cx="0" cy="0" rx="24" ry="11" transform="rotate(-30)"/><ellipse cx="0" cy="0" rx="24" ry="11" transform="rotate(26)"/><line x1="0" y1="0" x2="0" y2="36" stroke-width="1.5"/></g>
      <g transform="translate(620,16)"><ellipse cx="0" cy="0" rx="19" ry="8" transform="rotate(-22)"/><ellipse cx="0" cy="0" rx="19" ry="8" transform="rotate(33)"/><line x1="0" y1="0" x2="0" y2="27" stroke-width="1.3"/></g>
      <g transform="translate(730,32)"><ellipse cx="0" cy="0" rx="25" ry="11" transform="rotate(-36)"/><ellipse cx="0" cy="0" rx="25" ry="11" transform="rotate(24)"/><line x1="0" y1="0" x2="0" y2="36" stroke-width="1.6"/></g>
      <g transform="translate(840,20)"><ellipse cx="0" cy="0" rx="21" ry="9" transform="rotate(-25)"/><ellipse cx="0" cy="0" rx="21" ry="9" transform="rotate(30)"/><line x1="0" y1="0" x2="0" y2="30" stroke-width="1.4"/></g>
      <g transform="translate(950,36)"><ellipse cx="0" cy="0" rx="27" ry="12" transform="rotate(-30)"/><ellipse cx="0" cy="0" rx="27" ry="12" transform="rotate(22)"/><line x1="0" y1="0" x2="0" y2="40" stroke-width="1.7"/></g>
      <g transform="translate(1060,14)"><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(-18)"/><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(35)"/><line x1="0" y1="0" x2="0" y2="28" stroke-width="1.3"/></g>
      <g transform="translate(1150,28)"><ellipse cx="0" cy="0" rx="23" ry="10" transform="rotate(-28)"/><ellipse cx="0" cy="0" rx="23" ry="10" transform="rotate(26)"/><line x1="0" y1="0" x2="0" y2="34" stroke-width="1.5"/></g>
      <!-- Baris bawah -->
      <g transform="translate(30,290)"><ellipse cx="0" cy="0" rx="24" ry="10" transform="rotate(28)"/><ellipse cx="0" cy="0" rx="24" ry="10" transform="rotate(-22)"/><line x1="0" y1="0" x2="0" y2="-36" stroke-width="1.5"/></g>
      <g transform="translate(120,305)"><ellipse cx="0" cy="0" rx="19" ry="8" transform="rotate(22)"/><ellipse cx="0" cy="0" rx="19" ry="8" transform="rotate(-30)"/><line x1="0" y1="0" x2="0" y2="-28" stroke-width="1.3"/></g>
      <g transform="translate(320,310)"><ellipse cx="0" cy="0" rx="22" ry="10" transform="rotate(30)"/><ellipse cx="0" cy="0" rx="22" ry="10" transform="rotate(-24)"/><line x1="0" y1="0" x2="0" y2="-33" stroke-width="1.4"/></g>
      <g transform="translate(680,295)"><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(25)"/><ellipse cx="0" cy="0" rx="20" ry="9" transform="rotate(-28)"/><line x1="0" y1="0" x2="0" y2="-30" stroke-width="1.4"/></g>
      <g transform="translate(900,308)"><ellipse cx="0" cy="0" rx="25" ry="11" transform="rotate(32)"/><ellipse cx="0" cy="0" rx="25" ry="11" transform="rotate(-20)"/><line x1="0" y1="0" x2="0" y2="-38" stroke-width="1.6"/></g>
      <g transform="translate(1100,296)"><ellipse cx="0" cy="0" rx="21" ry="9" transform="rotate(26)"/><ellipse cx="0" cy="0" rx="21" ry="9" transform="rotate(-24)"/><line x1="0" y1="0" x2="0" y2="-32" stroke-width="1.4"/></g>
    </g>
  </svg>

  <div class="hero-content">
    <div class="hero-badge">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
      Buah Segar Setiap Hari
    </div>
    <h1>Toko Buah <em>Segar</em></h1>
    <p>Pilihan buah segar berkualitas tinggi, dipetik langsung dari kebun terbaik untuk keluarga Anda.</p>
    <div class="hero-pills">
      <span class="hero-pill"><span class="hero-pill-dot"></span>Gratis Ongkir</span>
      <span class="hero-pill"><span class="hero-pill-dot"></span>Garansi Segar</span>
      <span class="hero-pill"><span class="hero-pill-dot"></span>Bayar di Tempat</span>
    </div>
  </div>
</section>

<!-- ══ PRODUK ══ -->
<div class="section">
  <div class="section-header">
    <div>
      <div class="section-title">Produk Kami</div>
      <div class="section-sub">Buah pilihan segar setiap hari</div>
    </div>
    <button class="refresh-btn" onclick="location.reload()" title="Refresh produk" aria-label="Refresh produk">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
    </button>
  </div>

  <!-- Toolbar: search + sort -->
  <div class="toolbar fade-up">
    <div class="search-wrap">
      <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" id="search-input" placeholder="Cari buah... (cth: mangga, apel)" autocomplete="off" aria-label="Cari produk">
    </div>
    <select id="sort-select" aria-label="Urutkan produk">
      <option value="default">Urutan Default</option>
      <option value="price-asc">Harga: Termurah</option>
      <option value="price-desc">Harga: Termahal</option>
      <option value="name-asc">Nama: A → Z</option>
      <option value="name-desc">Nama: Z → A</option>
    </select>
  </div>

  <!-- Grid produk / loop for produk-->
  <div class="product-grid" id="product-grid">
    <?php if (count($produkList) > 0):
      $i = 0; foreach ($produkList as $row):
        $has_img = !empty($row['gambar']) && file_exists('uploads/' . $row['gambar']);
    ?>
    <div class="product-card fade-up"
         style="--delay:<?= $i * 75 ?>ms"
         data-nama="<?= strtolower(htmlspecialchars($row['nama_buah'])) ?>"
         data-harga="<?= (int)$row['harga'] ?>">

      <span class="product-badge-segar">Segar</span>

      <div class="product-img"
           onclick="openLightbox('<?= $has_img ? 'uploads/'.htmlspecialchars($row['gambar']) : '' ?>','<?= htmlspecialchars(addslashes($row['nama_buah'])) ?>','Rp <?= number_format($row['harga'],0,',','.') ?>')"
           title="Lihat gambar lebih besar">
        <?php if ($has_img): ?>
          <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_buah']) ?>" loading="lazy">
        <?php else: ?>
          <div class="img-placeholder">🍎</div>
        <?php endif; ?>
      </div>

      <div class="product-info">
        <h3><?= htmlspecialchars($row['nama_buah']) ?></h3>
        <p class="product-desc"><?= htmlspecialchars($row['deskripsi']) ?></p>
        <div class="product-footer">
          <span class="product-price">Rp <?= number_format($row['harga'], 0, ',', '.') ?></span>
          <button class="btn-beli" onclick="addToCart('<?= htmlspecialchars(addslashes($row['nama_buah'])) ?>')" aria-label="Beli <?= htmlspecialchars($row['nama_buah']) ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Beli
          </button>
        </div>
      </div>
    </div>
    <?php $i++; endforeach; else: ?>
      <div class="empty-msg">
        <span class="em-icon">🌱</span>
        Belum ada produk. Cek lagi nanti!
      </div>
    <?php endif; ?>

    <div id="no-result" aria-live="polite">
      <span class="nr-icon">🔍</span>
      <p>Produk "<strong id="no-result-query"></strong>" tidak ditemukan.</p>
    </div>
  </div>
</div>

<!-- ══ LIGHTBOX ══  / menampilkan atau zoom in produk-->
<div id="lightbox" role="dialog" aria-modal="true" aria-label="Preview gambar" onclick="closeLightbox()">
  <button id="lightbox-close" onclick="closeLightbox()" aria-label="Tutup preview">✕</button>
  <img id="lightbox-img" src="" alt="Preview">
  <div id="lightbox-info">
    <p id="lightbox-name"></p>
    <p id="lightbox-price"></p>
  </div>
</div>

<!-- ══ TOAST ══ / keranjang notifikasi-->
<div id="toast-container" aria-live="polite" aria-atomic="false"></div>

<!-- ══ BACK TO TOP / tombol balik atas ══ -->
<button id="back-top" aria-label="Kembali ke atas">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 15l-6-6-6 6"/></svg>
</button>

<!-- ══ FOOTER ══ -->
<footer class="site-footer">
  <div class="footer-brand">
    <div class="footer-brand-ico">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
    </div>
    Toko Buah Segar
  </div>
  <span class="footer-copy">&copy; <?= date('Y') ?> Toko Buah Segar &mdash; Buah segar, hidup sehat.</span>
</footer>

<script>
/* ─── FADE-IN SCROLL / disappearing floating button to the top─── */
const io = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (!e.isIntersecting) return;
    const el = e.target;
    const d  = parseInt(el.style.getPropertyValue('--delay')) || 0;
    setTimeout(() => el.classList.add('visible'), d);
    io.unobserve(el);
  });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

/* ─── LIVE SEARCH + SORT ─── */
const searchInput   = document.getElementById('search-input');
const sortSelect    = document.getElementById('sort-select');
const grid          = document.getElementById('product-grid');
const noResult      = document.getElementById('no-result');
const noResultQuery = document.getElementById('no-result-query');

function applyFilters() {
  const q     = searchInput.value.toLowerCase().trim();
  const sort  = sortSelect.value;
  const cards = [...grid.querySelectorAll('.product-card')];

  cards.forEach(c => {
    c.style.display = (q === '' || (c.dataset.nama || '').includes(q)) ? '' : 'none';
  });

  const visible = cards.filter(c => c.style.display !== 'none');
  visible.sort((a, b) => {
    const ha = parseInt(a.dataset.harga) || 0, hb = parseInt(b.dataset.harga) || 0;
    const na = a.dataset.nama || '', nb = b.dataset.nama || '';
    if (sort === 'price-asc')  return ha - hb;
    if (sort === 'price-desc') return hb - ha;
    if (sort === 'name-asc')   return na.localeCompare(nb);
    if (sort === 'name-desc')  return nb.localeCompare(na);
    return 0;
  });
  visible.forEach(c => grid.appendChild(c));

  if (visible.length === 0 && q !== '') {
    noResult.style.display = 'block';
    noResultQuery.textContent = searchInput.value;
  } else {
    noResult.style.display = 'none';
  }
}
searchInput.addEventListener('input', applyFilters);
sortSelect.addEventListener('change', applyFilters);

/* ─── TOAST NOTIFIKASI / JS for the keranjang beli─── */
function addToCart(nama) {
  const c     = document.getElementById('toast-container');
  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.innerHTML = `
    <div class="toast-ico">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div>
      <p class="toast-label">Ditambahkan ke keranjang!</p>
      <p class="toast-sub">${nama}</p>
    </div>
  `;
  c.appendChild(toast);
  setTimeout(() => {
    toast.classList.add('hide');
    setTimeout(() => toast.remove(), 320);
  }, 2800);
}

/* ─── LIGHTBOX ─── / gambar doang JS fitur zoom in produk */
const lightbox = document.getElementById('lightbox');
function openLightbox(src, nama, harga) {
  if (!src) return;
  document.getElementById('lightbox-img').src          = src;
  document.getElementById('lightbox-name').textContent  = nama;
  document.getElementById('lightbox-price').textContent = harga;
  lightbox.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeLightbox() {
  lightbox.style.display = 'none';
  document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

/* ─── BACK TO TOP / fitur JS buat eksekusi back to the top ─── */
const backTop = document.getElementById('back-top');
window.addEventListener('scroll', () => {
  backTop.classList.toggle('show', window.scrollY > 320);
}, { passive: true });
backTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
</script>
</body>
</html>