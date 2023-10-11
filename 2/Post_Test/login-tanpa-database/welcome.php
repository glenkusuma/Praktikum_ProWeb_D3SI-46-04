<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Selamat Datang</title>
</head>

<body>
    <h2>Selamat Datang, <?php echo $username; ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>