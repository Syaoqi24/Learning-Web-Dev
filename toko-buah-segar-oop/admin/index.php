<?php
require_once '../config/bootstrap.php';
$auth = new Auth();
$auth->requireLogin();

$produkModel = new Produk($conn, '../uploads/');
$produkList  = $produkModel->all();
$total       = $produkModel->count();
$total_val   = $produkModel->totalValue();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin — Toko Buah Segar</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="admin-body">

<!-- NAVBAR ADMIN -->
<nav class="admin-nav">
  <div class="admin-nav-brand">
    <div class="ni">🍉</div>
    Admin Panel
  </div>
  <div class="admin-nav-links">
    <a href="../index.php">🏪 Lihat Toko</a>
    <a href="../logout.php" class="btn-logout">Logout</a>
  </div>
</nav>

<div class="admin-wrap">

  <!-- PAGE HEADER -->
  <div class="admin-page-header">
    <div>
      <h2>Manajemen Produk (Admin)</h2>
      <p>Kelola seluruh data buah di toko Anda</p>
    </div>
    <a href="tambah.php" class="btn-primary">+ Tambah Buah</a>
  </div>

  <!-- NOTIF -->
  <?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success">✓ <?= htmlspecialchars($_GET['msg']) ?></div>
  <?php endif; ?>

  <!-- STAT CARDS -->
  <div class="stat-cards">
    <div class="stat-card">
      <div class="label">Total Produk</div>
      <div class="value"><?= $total ?> <span>item</span></div>
    </div>
    <div class="stat-card">
      <div class="label">Total Nilai Produk</div>
      <div class="value" style="font-size:1.2rem">Rp <?= number_format($total_val, 0, ',', '.') ?></div>
    </div>
  </div>

  <!-- TABLE CARD -->
  <div class="table-card">
    <div class="table-card-header">
      <h3>Daftar Buah</h3>
      <span style="font-size:.82rem;color:#6b7280"><?= $total ?> produk terdaftar</span>
    </div>
    <div class="table-wrapper">
      <table class="data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama Buah</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($produkList) > 0): ?>
            <?php $no = 1; foreach ($produkList as $row): ?>
            <tr>
              <td style="color:#9ca3af;font-size:.8rem"><?= $no++ ?></td>
              <td>
                <?php if (!empty($row['gambar']) && file_exists('../uploads/' . $row['gambar'])): ?>
                  <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" class="table-img" alt="">
                <?php else: ?>
                  <div class="no-img">🍎</div>
                <?php endif; ?>
              </td>
              <td style="font-weight:700"><?= htmlspecialchars($row['nama_buah']) ?></td>
              <td style="font-weight:700;color:#16a34a">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
              <td style="color:#6b7280;max-width:220px"><?= htmlspecialchars(substr($row['deskripsi'], 0, 70)) ?>...</td>
              <td><span class="badge-segar">Segar</span></td>
              <td>
                <div class="action-btns">
                  <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">✏ Edit</a>
                  <a href="hapus.php?id=<?= $row['id'] ?>"
                     class="btn-delete"
                     onclick="return confirm('Yakin ingin menghapus <?= htmlspecialchars($row['nama_buah']) ?>?')">🗑 Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="7" style="text-align:center;padding:48px;color:#9ca3af">
              Belum ada produk. <a href="tambah.php" style="color:#22c55e;font-weight:700">Tambah sekarang →</a>
            </td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>