<?php
require_once '../config/bootstrap.php';
$auth = new Auth();
$auth->requireLogin();

$produkModel = new Produk($conn, '../uploads/');
$id = (int)($_GET['id'] ?? 0);
$produkModel->delete($id);

header('Location: index.php?msg=Produk berhasil dihapus.');
exit;
?>