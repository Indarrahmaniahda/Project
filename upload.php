<?php


include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit(); // Keluar dari skrip setelah mengarahkan ke halaman login
}

$message = []; // Inisialisasi pesan kesalahan/sukses

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $cv_file = $_FILES['cv_file']['name'];
    $cv_file = filter_var($cv_file, FILTER_SANITIZE_STRING);
    $cv_ext = pathinfo($cv_file, PATHINFO_EXTENSION);
    $cv_rename = unique_id() . '.' . $cv_ext;
    $cv_file_size = $_FILES['cv_file']['size'];
    $cv_tmp_name = $_FILES['cv_file']['tmp_name'];
    $cv_folder = 'uploaded_files/' . $cv_rename;

    if (!empty($cv_file)) {
        if ($cv_file_size > 2000000) {
            $message[] = 'CV file size is too large!';
        } elseif (!in_array(strtolower($cv_ext), ['pdf'])) {
            $message[] = 'Invalid CV file format. Please upload a PDF file.';
        } else {
            // Upload CV file
            move_uploaded_file($cv_tmp_name, $cv_folder);

            // Insert CV information into the database
            $insert_cv = $conn->prepare("INSERT INTO `cv` (user_id, name, cv_file_name) VALUES (?, ?, ?)");
            if ($insert_cv->execute([$user_id, $name, $cv_rename])) {
                $message[] = 'CV added successfully!';
            } else {
                $message[] = 'Error: ' . implode(" ", $insert_cv->errorInfo()); // Menampilkan pesan kesalahan SQL
            }

            // Setelah mengunggah CV dengan sukses, arahkan pengguna kembali ke halaman profil
            header('location: profile.php');
            exit(); // Keluar dari skrip setelah mengarahkan kembali ke halaman profil
        }
    }
}   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <!-- Font Awesome CDN link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Custom CSS file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="form-container" style="min-height: calc(100vh - 19rem);">

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Tambahkan CV</h3>
            <!-- Menampilkan pesan sukses atau kesalahan -->
            <?php
            if (is_array($message) && !empty($message)) {
                foreach ($message as $msg) {
                    echo "<p>$msg</p>";
                }
            }
            ?>

            <div class="flex">
                <div class="col">
                    <p>Link CV</p>
                    <input type="text" name="name" placeholder="Link CV" maxlength="100" class="box">
                    <p>Unggah CV (PDF)</p>
                    <input type="file" name="cv_file" accept="application/pdf" class="box">
                </div>
            </div>
            <input type="submit" name="submit" value="Tambahkan CV" class="btn">
        </form>

        <!-- Menampilkan tautan ke file CV yang diunggah -->
        <?php if (!empty($cv_rename)): ?>
            <h4>Tautan ke CV:</h4>
            <p><a href="<?php echo $cv_folder; ?>" target="_blank">Lihat CV</a></p>
        <?php endif; ?>

    </section>

    <!-- update profile section ends -->
    
    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>
