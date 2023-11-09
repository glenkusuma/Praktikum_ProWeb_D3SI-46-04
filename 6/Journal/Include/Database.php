<?php
/**
 * Kelas Database untuk mengelola koneksi database.
 */
class Database
{
    /** @var string Host database. */
    private $host = "127.0.0.1";

    /** @var string Nama pengguna database. */
    private $username = "root";

    /** @var string Kata sandi database. */
    private $password = "root";

    /** @var string Nama database. */
    private $dbname = "blog_database";

    /** @var string Nama database. */
    private $port = "3307";

    /** @var mysqli Objek koneksi database. */
    public $conn;

    /**
     * Konstruktor untuk kelas Database.
     *
     * Menginisialisasi koneksi database baru dengan menggunakan kredensial yang diberikan.
     * Jika koneksi gagal, maka akan menghentikan skrip dan menampilkan pesan error.
     */
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname, $this->port);
        // Memeriksa apakah koneksi gagal
        if ($this->conn->connect_errno) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

?>