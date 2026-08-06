<?php
/**
 * Database
 *
 * Encapsulates the mysqli connection and initial schema/seed setup.
 * Implemented as a singleton so every part of the app shares one
 * connection instance instead of opening a new one per file.
 */
class Database
{
    private static ?Database $instance = null;
    private mysqli $conn;

    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'toko_buah_segar';

    // Private constructor: forces creation through getInstance().
    private function __construct()
    {
        $this->conn = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS);

        if ($this->conn->connect_error) {
            die('<p style="font-family:sans-serif;padding:2rem;color:#b91c1c">Koneksi database gagal: ' . $this->conn->connect_error . '</p>');
        }

        $this->conn->query("CREATE DATABASE IF NOT EXISTS `" . self::DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $this->conn->select_db(self::DB_NAME);
        $this->conn->set_charset('utf8mb4');

        $this->migrate();
        $this->seed();
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connection(): mysqli
    {
        return $this->conn;
    }

    private function migrate(): void
    {
        $this->conn->query("
            CREATE TABLE IF NOT EXISTS produk (
                id          INT PRIMARY KEY AUTO_INCREMENT,
                nama_buah   VARCHAR(100)    NOT NULL,
                harga       DECIMAL(12,2)   NOT NULL,
                deskripsi   TEXT,
                gambar      VARCHAR(255)
            )
        ");
    }

    private function seed(): void
    {
        $check = $this->conn->query("SELECT COUNT(*) AS c FROM produk")->fetch_assoc();
        if ((int) $check['c'] !== 0) {
            return;
        }

        $this->conn->query("
            INSERT INTO produk (nama_buah, harga, deskripsi, gambar) VALUES
            ('Apel Fuji',    15000, 'Apel segar impor dari Jepang, rasa manis sedikit asam dan renyah.',  ''),
            ('Mangga Harum', 12000, 'Mangga harum manis pilihan petani lokal pilihan terbaik.',           ''),
            ('Semangka',     20000, 'Semangka merah segar, manis, berair — sempurna di hari panas.',      ''),
            ('Jeruk Manis',   8000, 'Jeruk manis lokal kaya Vitamin C, dipetik segar setiap pagi.',       ''),
            ('Anggur Hijau', 35000, 'Anggur hijau tanpa biji impor, manis segar cocok untuk camilan.',    ''),
            ('Stroberi',     28000, 'Stroberi merah segar asam manis, kaya antioksidan.',                 '')
        ");
    }
}
