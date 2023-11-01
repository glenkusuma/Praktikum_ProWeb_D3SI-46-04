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
     * @return array<object>|false[] Data pos yang ditemukan dalam bentuk array.
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
                $posts[] = $row;
            }
        }
        // Mengembalikan array $posts yang berisi data pos.
        return $posts;
    }

    /**
     * Mengambil data pos berdasarkan ID.
     *
     * @param string $post_id   ID pos yang akan diambil.
     * @return object|string   Mengembalikan array berisi data pos jika berhasil, atau false jika tidak ditemukan.
     */
    public function getPostById($post_id)
    {
        // Membersihkan nilai ID pos
        $post_id = $this->conn->real_escape_string($post_id);

        // Gunakan prepared statement
        $query = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        // Bind parameter ID dengan tipe data "i" (integer)
        $stmt->bind_param("i", $post_id);

        // Eksekusi prepared statement
        $stmt->execute();

        // Dapatkan hasil query
        $result = $stmt->get_result();

        if (!$result->num_rows == 1) return "Data pos tidak ditemukan";

        // Data pos ditemukan, mengambil hasil querry berbentuk object
        return $result->fetch_object();

    }

    /**
     * Mengambil pos berdasarkan slug.
     *
     * @param string $slug Slug pos yang akan dicari.
     * @return object|string Data pos yang ditemukan dalam bentuk array atau false jika tidak ada yang ditemukan.
     */
    public function getPostBySlug($slug)
    {
        $slug = $this->conn->real_escape_string($slug);

        // Gunakan prepared statement
        $query = "SELECT * FROM posts WHERE slug = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bind_param("s", $slug);

        // Eksekusi prepared statement
        $result = $stmt->execute();

        if (!$stmt) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        
        $result = $stmt->get_result();
    
        if (!$result->num_rows == 1) return "Data pos tidak ditemukan";

        return $result->fetch_object();

    }

    /**
     * Membuat pos baru dan menyimpannya ke dalam database.
     *
     * @param string $title       Judul pos.
     * @param string $subtitle    Subjudul pos.
     * @param string $slug        Slug pos.
     * @param string $content     Konten pos.
     * @param string $image       URL gambar pos.
     * @return true|string Mengembalikan array dengan pesan sukses jika pembuatan pos berhasil, atau array dengan pesan kesalahan jika gagal.
     */
    public function createPost($title, $subtitle, $slug, $content, $image)
    {
        $title = $this->conn->real_escape_string($title);
        $subtitle = $this->conn->real_escape_string($subtitle);
        $slug = $this->conn->real_escape_string($slug);
        $image = $this->conn->real_escape_string($image);

        // Gunakan prepared statement
        $query = "INSERT INTO posts (title, subtitle, slug, content, image, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        // Bind parameter
        $stmt->bind_param("sssss", $title, $subtitle, $slug, $content, $image);

        $result = $stmt->execute();

        if (!$result) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        
        return true;

    }



    /**
     * Memperbarui data pos berdasarkan ID.
     *
     * @param string $post_id      ID pos yang akan diperbarui.
     * @param string $new_title Judul baru pos.
     * @param string $new_subtitle Subjudul baru pos.
     * @param string $new_slug Slug baru pos.
     * @param string $new_image Gambar baru pos.
     * @param string $new_content Konten baru pos.
     * @return bool|string True jika pos dihapus dengan sukses, pesan kesalahan jika terjadi kesalahan.
     */
    public function updatePost($post_id, $new_title, $new_subtitle, $new_slug, $new_image, $new_content)
    {
        // Gunakan prepared statement
        $query = "UPDATE posts SET title = ?, subtitle = ?, slug = ?, image = ?, content = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        // Bind parameter dengan tipe data: "sssssi" (string, string, string, string, string, integer)
        $stmt->bind_param("sssssi", $new_title, $new_subtitle, $new_slug, $new_image, $new_content, $post_id);
        $result = $stmt->execute();
        // Perbarui gagal
        if (!$result) return $stmt->error; // Mengembalikan pesan kesalahan MySQLi.
        // Perbarui Suksess
        return true;
    }

    /**
     * Hapus sebuah pos berdasarkan ID.
     *
     * @param int $postId ID dari pos yang akan dihapus.
     * @return bool|string True jika pos dihapus dengan sukses, pesan kesalahan jika terjadi kesalahan.
     */
    public function deletePostById($postId)
    {
        // Menyiapkan dan menjalankan query DELETE untuk menghapus pos dari database.
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) return $stmt->error; // Mengembalikan pesan kesalahan jika pernyataan yang telah disiapkan tidak dapat dibuat.
        
        var_dump($stmt);

        $stmt->bind_param("i", $postId);
        $result = $stmt->execute();

        var_dump($stmt);

        

        if (!$result) return $stmt->error; // Mengembalikan pesan kesalahan MySQLi.
        
        if (!$stmt->affected_rows > 0) return 'Pos tidak ditemukan'; 
        var_dump($result);

        $stmt->close();
        return true; // Penghapusan berhasil.
    }
}

?>
