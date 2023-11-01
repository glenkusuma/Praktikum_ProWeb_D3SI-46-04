<?php
require_once dirname(__FILE__) ."/Include/Post.php";

// Membuat instance(object) Post baru
$post = new Post();

// Mengambil data seluruh Post
$posts = $post->getAllPosts();

// Menset Charakter maksikum untuk konten yang di tampilkan pada tabel
$max_content_char = 100;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <style>
        table {
            border-collapse: collapse; /* Menghapus jarak antar sel di dalam tabel. */
            margin: 20px auto; /* Memberikan margin atas dan bawah sejauh 20px, yang akan mengatur tabel di tengah halaman. */
        }
        th, td {
            border: 1px solid #ccc; /* Mengatur garis tepi sel di dalam tabel. */
            padding: 8px; /* Memberikan jarak antara isi sel dengan batas sel di dalam tabel. */
            text-align: left; /* Mengatur teks agar berada di sebelah kiri dalam sel tabel. */
        }
        th {
            background-color: #f2f2f2; /* Memberikan latar belakang berwarna abu-abu pada baris judul tabel. */
        }
        .container {
            max-width: 768px; /* Mengatur lebar maksimum container. md 768px*/
            margin: 0 auto; /* Mengatur container agar berada di tengah halaman. */
            padding: 20px; /* Memberikan ruang padding di dalam container. */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Blog Posts</h1>
        <table>
            <tr>
                <th>Judul</th>
                <th>Subjudul</th>
                <th>Slug</th>
                <th>Gambar</th>
                <th>Konten</th>
            </tr>
            <!-- Looping melalui data post dan menampilkannya dalam tabel. -->
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?= $post->title ?></td>
                    <td><?= $post->subtitle ?></td>
                    <td><?= $post->slug ?></td>
                    <td><img src="<?= $post->image; ?>" alt="Post Image" width="150"></td>
                    <!-- Menggunakan operasi ternary (kondisional) untuk membatasi panjang konten 
                    dan menambahkan "..." jika melebihi panjang maksimum. -->
                    <td><?= (strlen($post->content) > $max_content_char) ? 
                    htmlspecialchars(substr($post->content, 0, $max_content_char) . "...") 
                    : htmlspecialchars($post->content); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
