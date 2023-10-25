<?php
// Menghubungkan ke database
$connection = mysqli_connect('localhost', 'root', '', 'course_db');

// Memeriksa koneksi database
if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Periksa apakah parameter "id" diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM contact WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        echo "Data dengan ID $id berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Menutup koneksi ke database
    mysqli_close($connection);
} else {
    echo "ID tidak ditemukan.";
}

// Mengarahkan kembali ke halaman utama
header('Location: contact_user.php'); 
?>
