<?php
    // Mendefinisikan nama file
    define('filename', 'data.txt');

    // Proses memasukan text kedalam file dari form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $key = $_POST['key'];
        $value = $_POST['value'];

        // memformat inputan sebagai pasangan key:value
        $input_data = "$key:$value\n";
    
        // Buka file data.txt untuk menambahkan (buat jika tidak ada)
        $file = fopen(filename, 'a');
    
        if ($file) {
            // Tulis konten yang dimasukkan ke dalam file
            fwrite($file, $input_data);
            // Tutup file
            fclose($file);
            $pesan = 'Teks telah berhasil ditulis/ditambahkan ke dalam file.';
        } else {
            $pesan = 'Error: Tidak dapat membuka file untuk menulis/menambahkan.';
        }
    }

    function print_file() :void {
        // Mengecek apakah file ada
        if (!file_exists(filename)) {
            echo "<h4> gagal membuka file <i>" . filename ."</i>, file tidak ada.</h4>";
            return;
        }

        // membuke file untuk reading
        $file = fopen(filename, 'r');
        
        // mengecek apakah file dapat di read
        if (!$file) {
            echo "Failed to open the file" . filename;
            return;
        }

        for ($i = 1; ($line = fgets($file)) !== false; $i++) {
            // membagi line dengan titik dua (:) untuk memisahkan index dan text
            list($index, $text) = explode(':', $line, 2);
    
            // Menampilkan nilai dalam bentuk table row dan data
            echo "<tr> <td>$i</td> <td>$index</td> <td>$text</td> <tr>";
        }
        // menutup file
        fclose($file);
        return;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Latihan Write, Append dan Read File</title>
</head>
<style>
    table {
        border-collapse: collapse; 
        border:1px solid #69899F;
    } 
    table td{
        border:1px dotted #000000;
        padding:5px;
    }
    table td:first-child{
        border-left:0px solid #000000;
    }
    table th{
    border:2px solid #69899F;
    padding:5px;
    }
    </style>
<body>
    <h1>Latihan Write, Append dan Read File</h1>
    <form action='<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>' method='post'>
        <label for='key'>Key: </label>
        <input type="text" id='key' name='key' rows='4' cols='50'></input><br><br>
        <label for='value'>Value:</label>
        <input type="text" id='value' name='value' rows='4' cols='50'></input><br><br>
        <input type='submit' value='Write/Append ke <?= filename ?>'>
    </form>

    <h5> <?= isset($pesan) ? $pesan : '' ?> </h6>

    <h4>Isi File <?= filename ?>:</h4>
    <table>
        <th>#</th>
        <th>key</th>
        <th>value</th>
        <?php print_file() ?>

    </table>
</body>
</html>
