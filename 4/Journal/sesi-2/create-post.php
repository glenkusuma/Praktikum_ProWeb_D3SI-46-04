<?php
require_once dirname(__FILE__) ."/Include/Post.php"; // Include the Post class

// Handle the form submission to create a new blog post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and process the form data
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $slug = $_POST["slug"];
    $content = $_POST["content"];
    $image = $_POST["image"];

    $post = new Post(); // Create an instance of the Post class

    // Call the createPost method to create a new post
    $result = $post->createPost($title, $subtitle, $slug, $content, $image);

    if ($result["success"]) {
        // Redirect to the blog post list page after creating the post
        header("Location: index.php"); // Replace with the actual page name.
        exit;
    } else {
        // Display an error message if post creation fails
        $error = $result["error"];
    }
}

$error = "error"
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
        <h1>Buat Post Baru</h1>
        <?=isset($error) ? "<h4 id='error'>Error: $error</h4>" : ""?>
        <form method="post" action="<?php htmlentities($_SERVER['PHP_SELF'])?>">
            <label for="title">Judul:</label>
            <input type="text" name="title" id="title" required>

            <label for="subtitle">Subjudul:</label>
            <input type="text" name="subtitle" id="subtitle" required>

            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" required>

            <label for="image">Image (URL):</label>
            <input type="url" name="image" id="image" placeholder="https://picsum.photos/1200/300" value="https://picsum.photos/1200/300" required>

            <h3>Markdown Editor</h3>
            <textarea id="file-input" cols="66" rows="15" name="content" placeholder="Hello World!"></textarea><br>

            <a href="index.php"><button type="button" name="cancel">Batal</button></a>
            <button type="submit">Buat Post</button>
        </form>
    </div>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("file-input") });
    </script>
</body>
</html>
