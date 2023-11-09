<?php
require_once dirname(__FILE__) ."/Include/Post.php"; // Sertakan kelas Post

$error = "contoh error";
// Tangani pengiriman formulir untuk membuat pos blog baru
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validasi dan proses data formulir
    $data = new stdClass();
    $data->title = $_POST['title'];
    $data->subtitle = $_POST['subtitle'];
    $data->slug = $_POST['slug'];
    $data->image = $_POST['image'];
    $data->content = $_POST['content'];

    $post = new Post(); // Buat instansi kelas Post

    // Panggil metode createPost untuk membuat pos baru
    $result = $post->createPost($data->title, $data->subtitle, $data->slug, $data->content, $data->image);

    if ($result === true) {
        // Redirect ke halaman daftar pos blog setelah membuat pos
        header("Location: index.php"); // Ganti dengan nama halaman sesungguhnya.
        exit;
    } else {
        // Tampilkan pesan kesalahan jika pembuatan pos gagal
        $error = $result;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Editor Markdown</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>
<style>
    body {
        background: #CCCCCC;
    }

    .container {
        width: 650px;
        margin: 0 auto;
        background: #f6f6f6;
        border: 1px solid #2C3E50;
        border-radius: 3px;
        padding: 5px;
    }

    .container form {
        max-width: 100%;
    }

    .container label {
        display: block;
        margin-bottom: 5px;
    }

    .container input[type="text"], 
    .container input[type="url"],
    .container textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box; 
    }

    .container button[type="submit"] {
        background-color: #008CBA;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .container a button[type="button"] {
        background-color: #E74C3C;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    h3 {
        text-align: center;
    }
    #error {
        color: white;
        background-color: #E74C3C;
        padding: 4px 4px;
    }
</style>
<body>
    <div class="container">
        <h1>Buat Post Baru</h1>
        <?=isset($error) ? "<h4 id='error'>Error: $error</h4>" : ""?>
        <form method="post" action="<?php htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="title">Judul:</label>
            <input type="text" name="title" id="title" value="<?= isset($data) ? $data->title  : "" ?>" required>

            <label for="subtitle">Subjudul:</label>
            <input type="text" name="subtitle" id="subtitle" value="<?= isset($data) ? $data->subtitle  : "" ?>" required>

            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" value="<?= isset($data) ? $data->slug  : "" ?>" required>

            <label for="image">Gambar (URL):</label>
            <input type="url" name="image" id="image" placeholder="https://picsum.photos/1200/300" 
            value="<?= isset($data) ? $data->image  : "https://picsum.photos/1200/300" ?>" required>

            <h3>Editor Markdown</h3>
            <textarea id="content" cols="66" rows="15" name="content" placeholder="Hello World!"><?= isset($data) ? $data->content  : "" ?></textarea><br>

            <a href="index.php"><button type="button" name="cancel">Batal</button></a>
            <button type="submit">Buat Post</button>
        </form>
    </div>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("content") });
    </script>
</body>
</html>
