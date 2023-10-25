<?php 
require_once(dirname(__FILE__) ."/Include/Parsedown.php");
require_once(dirname(__FILE__) ."/Include/Post.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $post_slug = $_GET['slug'];
}

$Parsedown = new Parsedown();
$Post = new Post();

$data = $Post->getPostBySlug($post_slug);

$content = $Parsedown->text($data->content);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data->title ?></title>
    <style>
        .container {
            max-width: 1024px;
            margin: 0 auto;
            padding: 20px;
            background: #f6f6f6;
            border: 1px solid #2C3E50;
            border-radius: 3px;
            text-align: center; /* Center-align content within the container */
        }

        .markdown-content {
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left; /* Left-align text within the content area */
        }


        /* Center-align the title and subtitle */
        #title {
            text-align: center;
            font-size: 3rem;
            margin-block-start: 1rem;
            margin-block-end: 0rem;
        }

        #subtitle {
            text-align: center;
            font-size: 1.5rem;
            margin-block-start: 0rem;
            margin-block-end: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?= $data->image ?>" alt="" width="1024px" >
        <h1 id="title"><?= $data->title ?></h1>
        <h4 id="subtitle"><?= $data->subtitle ?></h4>
        
        <div class="markdown-content">
            <?php echo $content; ?>
        </div>
    </div>
</body>
</html>

