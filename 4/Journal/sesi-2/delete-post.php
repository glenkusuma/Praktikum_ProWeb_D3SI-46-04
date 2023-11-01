<?php
require_once dirname(__FILE__) . "/Include/Post.php";

// Mulai atau lanjutkan sesi PHP
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $post_id = $_GET["id"];
    
    // Membuat instance objek Post
    $post = new Post();
    
    // Menghapus postingan berdasarkan ID
    $result = $post->deletePostById($post_id);
    


    if ($result == true) {
        // Penghapusan berhasil, tambahkan notifikasi sukses ke sesi
        $_SESSION["alert"] = [
            'type' => 'success',
            'message' => 'Postingan dengan id <b>#' . $post_id .' </b> berhasil dihapus!'
        ];
    } else {
        // Terjadi kesalahan saat menghapus postingan, tambahkan notifikasi danger ke sesi
        $_SESSION["alert"] = [
            'type' => 'danger',
            'message' => 'Postingan dengan id <b>#' . $post_id .'</b>, Terjadi kesalahan: <pre>' . $result . '</pre>'
        ];
    }
    } else {
        // Jika permintaan tidak sesuai, tambahkan notifikasi danger ke sesi
        $_SESSION["alert"] = [
            'type' => 'danger',
            'message' => 'Permintaan tidak valid.'
        ];
    }


var_dump($result);
// Arahkan kembali ke halaman utama
// header("Location: index.php");
exit;