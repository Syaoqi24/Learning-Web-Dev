<?php
/**
 * Produk
 *
 * Model class for the `produk` table. Every query that touches
 * this table now goes through here instead of being duplicated
 * across index.php, admin/index.php, admin/tambah.php,
 * admin/edit.php and admin/hapus.php.
 *
 * All queries use prepared statements, including find()/delete(),
 * which previously interpolated $id directly into the SQL string.
 */
class Produk
{
    private mysqli $conn;
    private string $uploadDir;
    private const ALLOWED_EXT = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private const MAX_SIZE = 2 * 1024 * 1024; // 2MB

    // $uploadDir is passed in because this class is used both from the
    // project root (index.php) and from admin/ (one level deeper).
    public function __construct(mysqli $conn, string $uploadDir = 'uploads/')
    {
        $this->conn = $conn;
        $this->uploadDir = $uploadDir;
    }

    public function all(): array
    {
        $result = $this->conn->query("SELECT * FROM produk ORDER BY id DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function count(): int
    {
        return (int) $this->conn->query("SELECT COUNT(*) AS c FROM produk")->fetch_assoc()['c'];
    }

    public function totalValue(): float
    {
        return (float) ($this->conn->query("SELECT SUM(harga) AS s FROM produk")->fetch_assoc()['s'] ?? 0);
    }

    /**
     * @param array $data      expects nama_buah, harga, deskripsi
     * @param array|null $file expects a single $_FILES['gambar'] entry
     * @return array list of validation error strings (empty = success)
     */
    public function create(array $data, ?array $file): array
    {
        [$errors, $filename] = $this->validateAndUpload($data, $file, null);
        if (!empty($errors)) {
            return $errors;
        }

        $stmt = $this->conn->prepare("INSERT INTO produk (nama_buah, harga, deskripsi, gambar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sdss', $data['nama_buah'], $data['harga'], $data['deskripsi'], $filename);
        $stmt->execute();
        $stmt->close();
        return [];
    }

    public function update(int $id, array $data, ?array $file): array
    {
        $existing = $this->find($id);
        if (!$existing) {
            return ['Produk tidak ditemukan.'];
        }

        [$errors, $filename] = $this->validateAndUpload($data, $file, $existing['gambar']);
        if (!empty($errors)) {
            return $errors;
        }

        $stmt = $this->conn->prepare("UPDATE produk SET nama_buah=?, harga=?, deskripsi=?, gambar=? WHERE id=?");
        $stmt->bind_param('sdssi', $data['nama_buah'], $data['harga'], $data['deskripsi'], $filename, $id);
        $stmt->execute();
        $stmt->close();
        return [];
    }

    public function delete(int $id): void
    {
        $row = $this->find($id);
        if ($row && !empty($row['gambar']) && file_exists($this->uploadDir . $row['gambar'])) {
            unlink($this->uploadDir . $row['gambar']);
        }

        $stmt = $this->conn->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Shared validation + image upload handling used by create() and update().
     * @return array{0: string[], 1: string} [errors, resolvedFilename]
     */
    private function validateAndUpload(array $data, ?array $file, ?string $currentFilename): array
    {
        $errors = [];
        $nama   = trim($data['nama_buah'] ?? '');
        $harga  = trim((string) ($data['harga'] ?? ''));

        if (empty($nama)) {
            $errors[] = 'Nama buah wajib diisi.';
        }
        if (!is_numeric($harga) || $harga <= 0) {
            $errors[] = 'Harga harus berupa angka positif.';
        }

        $filename = $currentFilename ?? '';

        if (!empty($file['name'])) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, self::ALLOWED_EXT, true)) {
                $errors[] = 'Format gambar tidak didukung (jpg, png, webp, gif).';
            } elseif ($file['size'] > self::MAX_SIZE) {
                $errors[] = 'Ukuran gambar maksimal 2MB.';
            } elseif (empty($errors)) {
                if (!empty($currentFilename) && file_exists($this->uploadDir . $currentFilename)) {
                    unlink($this->uploadDir . $currentFilename);
                }
                $filename = uniqid('buah_', true) . '.' . $ext;
                move_uploaded_file($file['tmp_name'], $this->uploadDir . $filename);
            }
        }

        return [$errors, $filename];
    }
}
