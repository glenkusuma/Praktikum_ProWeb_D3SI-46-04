<?php
require_once dirname(__FILE__) . "/Include/Post.php"; // Include the Post class

// Handle the form submission to create a new blog post
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_post = $_GET["id"];
    var_dump($id_post);

    $post = new Post();

    $data = $post->getPostById($id_post);

    if ($data === false) {
        echo '<h1>Post tidak ditemukan (404)</h1> <br> <a href="index.php">Home</a>';
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = new Post();
    $id_post = $_POST['id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $slug = $_POST['slug'];
    $image = $_POST['image'];
    $content = $_POST['content'];

    // Update the post using the updatePost() method
    $result = $post->updatePost($id_post, $title, $subtitle, $slug, $image, $content);

    if ($result) {
        // Redirect to the updated post or another page
        header("Location: index.php"); // Replace with the actual page name.
        exit;
    } else {
        $error = "Failed to update the post. Please check your data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Markdown Editor</title>
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
        box-sizing: border-box; /* Include padding in width calculation */
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
        <h1>Edit Post #<?= $data->id ?></h1>
        <?= isset($error) ? "<h4 id='error'>Error: $error</h4>" : "" ?>
        <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF']) ?>">
            <input type="hidden" name="id" value="<?= $data->id ?>"> <!-- Add a hidden field to submit the post ID -->

            <label for="title">Judul:</label>
            <input type="text" name="title" id="title" value="<?= $data->title ?>" required>

            <label for="subtitle">Subjudul:</label>
            <input type="text" name="subtitle" id="subtitle" required value="<?= $data->subtitle ?>">

            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" required value="<?= $data->slug ?>">

            <label for="image">Image (URL):</label>
            <input type="url" name="image" id="image" placeholder="https://picsum.photos/1200/300" value="<?= $data->image ?>" required>

            <h3>Markdown Editor</h3>
            <textarea id="content" cols="66" rows="15" name="content" placeholder="Hello World!"><?= $data->content ?></textarea><br>

            <a href="index.php"><button type="button" name="cancel">Batal</button></a>
            <button type="submit">Update Post</button>
        </form>
    </div>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("content") });
    </script>
</body>
</html>
