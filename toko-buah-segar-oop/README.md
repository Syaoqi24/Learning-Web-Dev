# Toko Buah Segar — OOP Refactor

A small PHP + MySQL fruit-store CRUD app (public catalog + admin panel),
refactored from a procedural implementation into an object-oriented one.

## What changed

The original version worked correctly, but every admin page repeated the
same session-check code, and every CRUD query (SELECT/INSERT/UPDATE/DELETE
on `produk`) was duplicated inline across 4–5 files. Two files also built
SQL by interpolating `$id` directly into the query string instead of using
a prepared statement.

This refactor extracts that repeated logic into three classes:

| Class        | Responsibility                                               | Replaces                                                                                                               |
| ------------ | ------------------------------------------------------------ | ---------------------------------------------------------------------------------------------------------------------- |
| `Database` | Singleton connection + schema migration/seed                 | the old`config/database.php` script                                                                                  |
| `Auth`     | Admin session check, login attempt, logout                   | copy-pasted`session_start()` + `isset($_SESSION[...])` in 5 files                                                  |
| `Produk`   | All CRUD + validation + image upload for the`produk` table | duplicated queries in`index.php`, `admin/index.php`, `admin/tambah.php`, `admin/edit.php`, `admin/hapus.php` |

Each PHP file (`index.php`, `login.php`, `admin/tambah.php`, etc.) is now a
thin controller: it instantiates the relevant class and calls a method,
instead of containing the query/validation logic itself.

## Before → After example

**Before** (`admin/hapus.php`, id interpolated directly into SQL):

```php
$id  = (int)($_GET['id'] ?? 0);
$row = $conn->query("SELECT gambar FROM produk WHERE id = $id LIMIT 1")->fetch_assoc();
if ($row) {
    if (!empty($row['gambar']) && file_exists('../uploads/' . $row['gambar']))
        unlink('../uploads/' . $row['gambar']);
    $conn->query("DELETE FROM produk WHERE id = $id");
}
```

**After**:

```php
$produkModel = new Produk($conn, '../uploads/');
$produkModel->delete($id);
```

`Produk::delete()` internally uses a prepared statement (`WHERE id = ?`),
so this also closes a minor SQL-injection risk from the original version.

## Structure

```
classes/
  Database.php   # singleton mysqli connection + migrate/seed
  Auth.php       # session-based admin auth
  Produk.php     # produk table: all(), find(), create(), update(), delete()
config/
  bootstrap.php  # autoloads classes, exposes $conn
index.php, login.php, logout.php, admin/*.php   # thin controllers
```

## Tech

PHP (mysqli, OOP), MySQL, vanilla HTML/CSS/JS (search, sort, lightbox on
the storefront page).
