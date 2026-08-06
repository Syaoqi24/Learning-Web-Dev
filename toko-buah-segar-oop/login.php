<?php
require_once 'config/bootstrap.php';
$auth = new Auth();

if ($auth->isLoggedIn()) {
    header('Location: admin/index.php'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = trim($_POST['password'] ?? '');
    if ($auth->attempt($u, $p)) {
        header('Location: admin/index.php'); exit;
    }
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Toko Buah Segar</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-page">

  <!-- Pola daun background -->
  <svg class="login-bg-pattern" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice">
    <g fill="none" stroke="#5a8a3c" stroke-width="1.2" stroke-linecap="round">
      <g transform="translate(60,50)"><ellipse cx="0" cy="0" rx="22" ry="9" transform="rotate(-30)"/><ellipse cx="0" cy="0" rx="22" ry="9" transform="rotate(28)"/><line x1="0" y1="0" x2="0" y2="32"/></g>
      <g transform="translate(700,80)"><ellipse cx="0" cy="0" rx="20" ry="8" transform="rotate(-25)"/><ellipse cx="0" cy="0" rx="20" ry="8" transform="rotate(32)"/><line x1="0" y1="0" x2="0" y2="28"/></g>
      <g transform="translate(50,520)"><ellipse cx="0" cy="0" rx="18" ry="8" transform="rotate(25)"/><ellipse cx="0" cy="0" rx="18" ry="8" transform="rotate(-28)"/><line x1="0" y1="0" x2="0" y2="-26"/></g>
      <g transform="translate(740,500)"><ellipse cx="0" cy="0" rx="22" ry="9" transform="rotate(22)"/><ellipse cx="0" cy="0" rx="22" ry="9" transform="rotate(-30)"/><line x1="0" y1="0" x2="0" y2="-32"/></g>
      <g transform="translate(150,30)"><ellipse cx="0" cy="0" rx="16" ry="7" transform="rotate(-20)"/><ellipse cx="0" cy="0" rx="16" ry="7" transform="rotate(35)"/><line x1="0" y1="0" x2="0" y2="22"/></g>
      <g transform="translate(600,560)"><ellipse cx="0" cy="0" rx="16" ry="7" transform="rotate(20)"/><ellipse cx="0" cy="0" rx="16" ry="7" transform="rotate(-35)"/><line x1="0" y1="0" x2="0" y2="-22"/></g>
    </g>
  </svg>

  <div class="login-box">
    <div class="login-logo">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
    </div>
    <h2>Selamat Datang</h2>
    <p class="login-sub">Masuk ke panel admin Toko Buah Segar</p>

    <?php if ($error): ?>
      <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               placeholder="admin" required
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-primary btn-block">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
        Masuk ke Dashboard
      </button>
    </form>
    <a href="index.php" class="back-link">← Kembali ke Toko</a>
  </div>
</body>
</html>