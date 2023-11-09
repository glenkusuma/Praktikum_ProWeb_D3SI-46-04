<?php
require_once dirname(__FILE__) . "/Include/Post.php";
require_once dirname(__FILE__) ."/Include/NotificationManager.php";
// Mulai atau lanjutkan sesi PHP
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $post_id = $_GET["id"];
    // Membuat instance objek Post
    $post = new Post();
    // Menghapus postingan berdasarkan ID
    $result = $post->deletePostById($post_id);
    // Terjadi kesalahan saat menghapus postingan, tambahkan notifikasi danger ke sesi
    if (!$result == true) {
        NotificationManager::setAlert(
            'danger', 
            'Postingan dengan id <b>#' . $post_id .'</b>, Terjadi kesalahan: <pre>' . $result . '</pre>'
        );
        // Debugging
        // echo "<pre>" . var_dump($result); "</pre>";
        // echo "<pre>" . var_dump($_SESSION); "</pre>";/
        // Arahkan kembali ke halaman utama
        header("Location: index.php");
        exit;
    }
    // Penghapusan berhasil, tambahkan notifikasi sukses ke sesi
    NotificationManager::setAlert(
        'success',
        'Postingan dengan id <b>#' . $post_id .' </b> berhasil dihapus!'
    );
    } else {
        NotificationManager::setAlert(
            'danger',
            'Permintaan Delete tidak valid.'
        );
    }
// Debugging
// echo "<pre>" . var_dump($result); "</pre>";
// echo "<pre>" . var_dump($_SESSION); "</pre>";
// Arahkan kembali ke halaman utama
header("Location: index.php");
exit;