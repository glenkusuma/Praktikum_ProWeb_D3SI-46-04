<?php
/**
 * Kelas NotificationManager untuk mengelola Notifikasi.
 */
class NotificationManager
{
    /**
     * Mengatur pesan peringatan.
     *
     * @param string $type Jenis peringatan (success, danger, or info).
     * @param string $message Pesan yang akan ditampilkan dalam peringatan.
     *
     * @return void
     */
    public static function setAlert($type, $message) {
        $_SESSION["alert"] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Dapatkan dan hapus pesan peringatan yang tersimpan dalam bentuk peringatan berformat HTML.
     *
     * @return string|null Pesan peringatan dalam format HTML, atau null jika tidak ada peringatan yang tersimpan.
     */
    public static function getAlert() {
        if (isset($_SESSION["alert"])) {
            $alert = $_SESSION["alert"];
            unset($_SESSION["alert"]);
            return '<div class="alert ' . $alert['type'] . '">' . $alert['message'] . '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
        } else {
            return null;
        }
    }
}

