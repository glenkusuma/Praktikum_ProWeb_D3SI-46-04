<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi</h2>
    <form method="post" action="process_register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Daftar">
    </form>
    <a href="./login.php">login</a>
</body>
</html>
