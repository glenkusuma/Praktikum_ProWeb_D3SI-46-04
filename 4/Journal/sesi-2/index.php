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

$result = "Fatal error: Class 'MySQLi' not found?";
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

        /* Gaya tombol "View" */
        .view-btn {
            background-color: #4CAF50; /* Warna latar belakang hijau */
        }

        /* Gaya tombol "Edit" */
        .edit-btn {
            background-color: #008CBA; /* Warna latar belakang biru */
        }

        /* Gaya tombol "Delete" */
        .delete-btn {
            background-color: #f44336; /* Warna latar belakang merah */
            height: 28px; /* Tinggi tombol, disesuaikan dengan preferensi desain Anda */
        }

        .no-padding {
            padding: 0px;
        }


        .alert {
        position: relative;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        font-size: 16px;
        line-height: 1.5;
        text-align: center;
        transition-delay: 2s;
        font-size: 16pt;
        }

        .alert.success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert.danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert.info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        /* Gaya untuk tombol "x" (tutup) */
        .close {
            font-size: 20px;
            background: none;
            border: none;
            color: inherit;
            position: absolute;
            top: 0;
            right: 0;
            margin: 10px;
            font-weight: bold;
            line-height: 1;
            cursor: pointer;
            transition: 0.3s;
        }

        .close:hover {
            filter: brightness(70%);  
        }
        
        /* Gaya untuk notifikasi saat di-close (dengan opasitas 0) */
        .alert.hide {
            opacity: 0;
            transition: opacity 2s; /* Transisi untuk opasitas dengan penundaan 2 detik */
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['alert'])) {
            $alert = $_SESSION['alert'];
            $type = $alert['type'];
            $message = $alert['message'];
            echo '<div class="alert ' . $type . '">' . $message . '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
            unset($_SESSION['alert']);
        }
        ?>
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
                    <!-- Menggunakan operasi ternary (kondisional) untuk membatasi panjang konten dan menambahkan "..." jika melebihi panjang maksimum. -->
                    <td><?= (strlen($post->content) > $max_content_char) ? htmlspecialchars(substr($post->content, 0, $max_content_char) . "...") : htmlspecialchars($post->content); ?></td>
                    <td><?= $post->created_at ?></td>
                    <td><?= $post->updated_at ?></td>
                    <td class="no-padding">
                        <div class="action-buttons">
                            <a class="button view-btn" href="view-post.php?slug=<?= $post->slug ?>">View</a>
                            <a class="button edit-btn" href="edit-post.php?id=<?= $post->id ?>">Edit</a>
                            <button class="button delete-btn" onclick="confirmDelete(<?= $post->id ?>)">Delete</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
    // Script untuk konfirmasi delete
    function confirmDelete(postId) {
        const result = confirm("Apakah Anda yakin ingin menghapus postingan ini?");
        if (result) {
            // Redirect ke delete-post.php
            window.location.href = `delete-post.php?id=${postId}`;
        }
    }

    // Menutup notifikasi ketika tombol "x" diklik
    document.addEventListener('DOMContentLoaded', function () {
        const closeButtons = document.querySelectorAll('.alert .close');
        closeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const alert = this.parentNode;
                alert.classList.add('hide');
                setTimeout(() => {
                    alert.style.display = 'none'; // Menyembunyikan notifikasi setelah selesai transisi
                }, 1700);
            });
        });
    });
    </script>
</body>
</html>
