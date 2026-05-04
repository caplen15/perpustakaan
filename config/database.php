<?php
/**
 * Konfigurasi & Koneksi Database
 * Sistem Manajemen Perpustakaan
 */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'perpustakaan');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Set charset (support emoji & karakter khusus)
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {

    // Log error untuk developer (tidak ditampilkan ke user)
    error_log("Database connection failed: " . $conn->connect_error);

    // Tampilan error user-friendly
    die("
    <!DOCTYPE html>
    <html>
    <head>
        <title>Error</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-danger shadow'>
                <h4 class='mb-3'>Koneksi Database Gagal</h4>
                <p>Maaf, sistem tidak dapat terhubung ke database.</p>
                <hr>
                <small>Silakan hubungi administrator atau coba lagi nanti.</small>
            </div>
        </div>
    </body>
    </html>
    ");
}

date_default_timezone_set('Asia/Jakarta');


function sanitize($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $conn->real_escape_string($data);
}

function closeConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
    }
}
?>