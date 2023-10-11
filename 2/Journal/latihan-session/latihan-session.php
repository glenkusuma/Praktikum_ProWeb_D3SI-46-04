<?php
    // Inisialisasi session
    session_start();
    // Fungsi untuk membersihkan dan memvalidasi input
    function validate_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    // Proses form jika user mensubmit form 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        switch ($_POST['management_session']) {
            // Jika pengguna mengeklik tombol 'Buat Session'
            case 'Buat Session':
                $user = validate_input($_POST['user']);
                // Buat session 'user' dengan nilai nama pengguna
                $_SESSION['user'] = $user;
                $pesan = "Session berhasil dibuat untuk pengguna: $user";
                break;
            // Jika pengguna mengeklik tombol 'Hapus Session'
            case 'Hapus Session':
                // Hapus session 'user'
                unset($_SESSION['user']);
                $pesan = 'Session user berhasil dihapus (unsset).';
                break;
        }
    }
    // Memberikan nilai variable user dari session 'user', jika tidak ada menghapus variable user
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }else{
        unset($user);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manajemen Session</title>
    </head>
    <body>
        <h2>Manajemen Session</h2>
        <form method='post' action='<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>'>
            <label for='user'><b>User :</b></label>
            <input type='text' id='user' name='user' value='<?= isset($user) ? $user : '' ?>' <?= isset($user) ? 'disabled' : '' ?>> 
            <input type='submit' name='management_session' value='<?= isset($user) ? 'Hapus Session' : 'Buat Session' ?>' >
        </form>
        
        <p><b>Pesan:</b> <?= isset($pesan) ? $pesan : ''?> </p>
        <br>
        <b>_POST:</b>
        <pre> <?= var_dump($_POST) ?> </pre>
        <b>_SESSION:</b>
        <pre> <?= var_dump($_SESSION) ?></pre>
    </body>
</html>