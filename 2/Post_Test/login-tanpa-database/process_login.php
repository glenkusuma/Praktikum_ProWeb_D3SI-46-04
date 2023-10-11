<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Baca data pengguna dari file teks
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($storedUsername, $storedPassword) = explode(':', $user);
        
        if ($username === $storedUsername && password_verify($password, $storedPassword)) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: welcome.php'); // Redirect ke halaman selamat datang jika login berhasil
            exit;
        }
    }
    // header('Location: login.php');
    echo 'Login gagal. Silakan coba lagi. <a href="./login.php">login</a>';

}
?>