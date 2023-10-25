<link rel="stylesheet" href="css/3.css">
<?php
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

// Menghubungkan ke database
$connection = mysqli_connect('localhost', 'root', '', 'course_db');

// Memeriksa koneksi database
if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah tombol "Hapus Tabel" ditekan
if (isset($_POST['hapus_tabel'])) {
    // Query SQL untuk menghapus tabel "contact"
    $sql = "DROP TABLE IF EXISTS contact";
    if (mysqli_query($connection, $sql)) {
        echo "Tabel 'contact' berhasil dihapus.";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Query SQL untuk mengambil data dari tabel "contact"
$sql = "SELECT * FROM contact";
$result = mysqli_query($connection, $sql);

// Periksa apakah query berhasil dieksekusi

// Menutup koneksi ke database
mysqli_close($connection);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact User</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<style>
    body {
        background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
        background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
    }

    .footer {
        background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
        background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    /* Gaya header tabel */
    th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    /* Gaya sel dalam tabel */
    td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    /* Gaya baris bergantian */
    tr:nth-child(even) {
       
    }

    tr{
       
    }

    /* Gaya pesan jika tidak ada data */
    .no-data {
        text-align: center;
        color: #777;
        font-style: italic;
    }
</style>

<body>

    <?php include '../components/admin_header.php'; ?>

    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";

                // Pastikan ada kolom 'id' dalam tabel 'contact'
                if (isset($row['id'])) {
                    echo "<td><a href='hapus.php?id=" . $row['id'] . "'>Hapus</a></td>";
                } else {
                    echo "<td>Tidak ada ID</td>";
                }

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data yang ditemukan dalam tabel contact.</td></tr>";
        }
        ?>
    </table>

    <?php include '../components/footer.php'; ?>

    <script src="../js/admin_script.js"></script>

</body>

</html>