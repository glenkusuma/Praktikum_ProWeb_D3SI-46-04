<?php
require_once "Database.php";

/**
 * Kelas Post untuk mengelola data pos dalam database.
 */
class Post extends Database
{
    /**
     * Mengambil semua data pos dari tabel "posts".
     *
     * @return array|false[] Data pos yang ditemukan dalam bentuk array.
     */
    public function getAllPosts()
    {
        // Menyiapkan query untuk mengambil semua data dari tabel "posts".
        $query = "SELECT * FROM posts"; 
        // Mengeksekusi query dan menyimpan hasilnya di variabel $result.
        $result = $this->conn->query($query);
        // Membuat array kosong $posts untuk menyimpan data pos.
        $posts = [];
        // Memeriksa apakah ada data yang ditemukan.
        if ($result->num_rows > 0) {
            // Jika data ditemukan, lakukan pengulangan untuk setiap baris hasil.
            while ($row = $result->fetch_object()) {
                // Menambahkan data pos ke dalam array $posts. 
                // fetch_object() -> mengambil hasil querry berbentuk object
                $posts[] = $row;
            }
        }
        // Mengembalikan array $posts yang berisi data pos.
        return $posts;
    }
}
?>
