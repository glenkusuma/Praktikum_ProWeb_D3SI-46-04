# Login Tanpa Database

## Explaination

1. `register.php`:
   - **Input:** Ini adalah formulir HTML yang menerima input pengguna untuk registrasi akun baru. Form ini meminta username dan password.
   - **Proses:** Ketika pengguna mengirimkan formulir, formulir ini mengirimkan permintaan POST ke `process_register.php`.
   - **Output:** Jika registrasi berhasil, pengguna akan diarahkan ke halaman login. Jika terjadi kesalahan, pesan kesalahan akan ditampilkan bersama dengan tautan untuk kembali ke halaman registrasi.
   - **Error Handling:** File ini menangani kesalahan terkait duplikasi username selama proses registrasi dan masalah potensial saat pengguna mengirimkan formulir.

2. `process_register.php`:
   - **Input:** Menerima permintaan POST dari `register.php` dengan username dan password yang dimasukkan oleh pengguna.
   - **Proses:** Mengecek apakah username yang diberikan sudah ada dalam file `users.txt`, dan jika belum, menambahkan pengguna ke file tersebut. Password juga di-hash menggunakan `password_hash` untuk penyimpanan yang aman.
   - **Output:** Menampilkan pesan sukses dan tautan ke halaman login jika registrasi berhasil. Jika terjadi kesalahan (misalnya, username ganda atau masalah saat menulis ke file), pesan kesalahan akan ditampilkan bersama dengan tautan untuk kembali ke halaman registrasi.
   - **Error Handling:** Menangani kesalahan terkait duplikasi username dan operasi file.

3. `login.php`:
   - **Input:** Ini adalah formulir HTML tempat pengguna memasukkan username dan password untuk login.
   - **Proses:** Ketika pengguna mengirimkan formulir, formulir ini mengirimkan permintaan POST ke `process_login.php`.
   - **Output:** Jika login berhasil, pengguna akan diarahkan ke halaman selamat datang. Jika terjadi kesalahan, pesan kesalahan akan ditampilkan bersama dengan tautan untuk kembali ke halaman login.
   - **Error Handling:** Menangani kesalahan terkait upaya login yang tidak berhasil.

4. `process_login.php`:
   - **Input:** Menerima permintaan POST dari `login.php` dengan username dan password yang dimasukkan.
   - **Proses:** Mengecek apakah username dan password yang dimasukkan cocok dengan data yang ada dalam file `users.txt`. Jika cocok, maka sesi dimulai dan pengguna diarahkan ke halaman selamat datang.
   - **Output:** Jika login berhasil, pengguna akan diarahkan ke halaman selamat datang. Jika terjadi kesalahan (misalnya, kredensial tidak valid), pesan kesalahan akan ditampilkan bersama dengan tautan untuk kembali ke halaman login.
   - **Error Handling:** Menangani kesalahan terkait kredensial yang tidak valid selama proses login.

5. `welcome.php`:
   - **Input:** Halaman ini memeriksa apakah pengguna sudah login dengan memeriksa data sesi.
   - **Proses:** Jika pengguna sudah login, halaman ini menampilkan pesan selamat datang dengan username pengguna. Jika tidak, pengguna diarahkan kembali ke halaman login.
   - **Output:** Menampilkan pesan selamat datang dan tautan untuk logout.
   - **Error Handling:** Menangani kesalahan terkait pengguna yang belum login dengan mengarahkan mereka kembali ke halaman login.

6. `logout.php`:
   - **Input:** Skrip ini menangani permintaan logout pengguna.
   - **Proses:** Ini menghapus sesi pengguna dan mengarahkan mereka kembali ke halaman login.
   - **Output:** Menampilkan pesan yang mengindikasikan logout berhasil.
   - **Error Handling:** Tidak ada yang spesifik terkait skrip ini. Skrip ini utamanya menjalankan tindakan logout.

7. `users.txt`:
   - **Input:** File ini menyimpan data pengguna dalam format username:hashed_password.
   - **Proses:** File ini dibaca oleh `process_register.php` dan `process_login.php` untuk memeriksa kredensial pengguna dan menyimpan data pengguna baru.
   - **Output:** Tidak ada. Ini adalah file data, bukan skrip.
   - **Error Handling:** Tidak ada dalam file ini; Error Handling dilakukan dalam skrip PHP yang mengaksesnya.

## Flow Diagram

![Flow Diagram](/2/Post_Test/login-tanpa-database/flow.png)
