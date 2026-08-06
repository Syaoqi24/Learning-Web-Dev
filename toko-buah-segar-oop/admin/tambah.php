<?php
require_once '../config/bootstrap.php';
$auth = new Auth();
$auth->requireLogin();

$produkModel = new Produk($conn, '../uploads/');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $produkModel->create([
        'nama_buah' => $_POST['nama_buah'] ?? '',
        'harga'     => $_POST['harga'] ?? '',
        'deskripsi' => trim($_POST['deskripsi'] ?? ''),
    ], $_FILES['gambar'] ?? null);

    if (empty($errors)) {
        header('Location: index.php?msg=Produk berhasil ditambahkan!'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk — Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="admin-body">

<nav class="admin-nav">
  <div class="admin-brand">
    <div class="admin-brand-ico">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
    </div>
    Admin Panel
  </div>
  <div class="admin-nav-links">
    <a href="index.php">← Kembali</a>
    <a href="../logout.php" class="btn-logout">Logout</a>
  </div>
</nav>

<div class="admin-wrap">
  <div class="admin-page-header">
    <div>
      <h2>Tambah Produk Baru</h2>
      <p>Isi form berikut untuk menambahkan buah ke katalog</p>
    </div>
  </div>

  <?php foreach ($errors as $e): ?>
    <div class="alert alert-error">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <?= htmlspecialchars($e) ?>
    </div>
  <?php endforeach; ?>

  <div class="form-card">
    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nama_buah">Nama Buah *</label>
        <input type="text" id="nama_buah" name="nama_buah"
               placeholder="cth. Apel Fuji"
               value="<?= htmlspecialchars($_POST['nama_buah'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label for="harga">Harga (Rp) *</label>
        <input type="number" id="harga" name="harga"
               placeholder="cth. 15000" min="0"
               value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsikan buah ini..."><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
      </div>
      <div class="form-group">
        <label for="gambar">Gambar Produk <span style="color:var(--ink-muted);font-weight:400">(maks. 2MB — jpg, png, webp)</span></label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
      </div>
      <div class="form-actions">
        <button type="submit" class="btn-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="15" height="15" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Produk
        </button>
        <a href="index.php" class="btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>