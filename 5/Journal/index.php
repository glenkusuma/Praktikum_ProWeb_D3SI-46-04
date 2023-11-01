<?php
session_start();
require_once dirname(__FILE__) ."/Include/Post.php";

// Membuat instance (objek) Post baru
$post = new Post();
// Mengambil data semua Post
$posts = $post->getAllPosts();
// Mengatur jumlah karakter maksimum untuk konten yang ditampilkan dalam tabel
$max_content_char = 100;
$post_id = '10';
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
            max-width: 1536px; /* Mengatur lebar maksimum container. sm (640px) md (768px) lg (1024px) xl (1280px) 2xl (1536px)*/
            margin: 0 auto; /* Mengatur container agar berada di tengah halaman. */
            padding: 20px; /* Memberikan ruang padding di dalam container. */
        }

        .button {
            color: white;
            padding: 4px 10px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin: 2px 4px;
        }

        .button:hover {
            filter: brightness(120%);
            cursor: pointer;
        }

        /* Gaya untuk tombol "Buat Post" */
        .create-btn {
            background-color: #008CBA; /* Warna latar belakang biru */
            padding: 8px 20px;
        }

        /* Gaya untuk wadah aksi (tombol "view" dan "edit") */
        .action-buttons {
            display: flex;
            text-align: center; /* Pusatkan teks dalam tombol */
            margin: 5px; /* Tambahkan margin untuk jarak antara tombol */
        }

        /* Gaya tombol "Edit" */
        .edit-btn {
            background-color: #008CBA; /* Warna latar belakang biru */
        }

        .no-padding {
            padding: 0px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Blog Posts</h1>

        <!-- Tombol "Buat Post" -->
        <a class="button create-btn" href="create-post.php">Buat Post</a>

        <table>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Subjudul</th>
                <th>Slug</th>
                <th>Gambar</th>
                <th>Konten</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Action</th>
            </tr>
            <!-- Looping melalui data post dan menampilkannya dalam tabel. -->
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= $post->title ?></td>
                    <td><?= $post->subtitle ?></td>
                    <td><?= $post->slug ?></td>
                    <td class="no-padding"><img src="<?= $post->image; ?>" alt="Post Image" width="200"></td>
                    <!-- Menggunakan operasi ternary (kondisional) untuk membatasi panjang konten dan menambahkan
                    "..." jika melebihi panjang maksimum. -->
                    <td><?= (strlen($post->content) > $max_content_char) ? 
                    htmlspecialchars(substr($post->content, 0, $max_content_char) 
                    . "...") : htmlspecialchars($post->content); ?></td>
                    <td><?= $post->created_at ?></td>
                    <td><?= $post->updated_at ?></td>
                    <td class="no-padding">
                        <div class="action-buttons">
                            <a class="button edit-btn" href="edit-post.php?id=<?= $post->id ?>">Edit</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
