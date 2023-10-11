<?php
function checkIfUserExists($username) {
$users = file('users.txt', FILE_IGNORE_NEW_LINES);

foreach ($users as $user) {
    list($storedUsername, $storedPassword) = explode(':', $user);

    if ($username === $storedUsername) {
    return true;
    }
}

return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (checkIfUserExists($username)) {
    echo "Registrasi akun gagal. Username '$username' sudah dipakai. <a href='register.php'>Kembali</a>";
} else {
    $file = fopen('users.txt', 'a');

    if ($file) {
    $user_data = "$username:$password\n";

    if (fwrite($file, $user_data)) {
        fclose($file);

        echo "Registrasi akun <b>$username</b> berhasil. <a href='login.php'>Login</a>";
    } else {
        fclose($file);

        echo "Registrasi akun <b>$username</b> gagal. Silakan coba lagi. <a href='register.php'>Kembali</a>";
    }
    } else {
    echo "Registrasi akun <b>$username</b> gagal. Silakan coba lagi. <a href='register.php'>Kembali</a>";
    }
}
}

?>