<?php
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

$message = array(); // Inisialisasi array pesan

if (isset($_POST['submit'])) {

   $id = unique_id();
   $title = $_POST['title'];
   $status = $_POST['status'];

   $materi = array();
   $judul = array();

   for ($i = 1; $i <= 10; $i++) {
      $materi[] = isset($_POST['m' . $i]) ? $_POST['m' . $i] : '';
      $judul[] = isset($_POST['j' . $i]) ? $_POST['j' . $i] : '';
   }

   // Handle the file upload
   $image = $_FILES['image']['name'];
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_folder = '../uploaded_files/' . $rename;
   move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);

   // Insert data into the database
   $add_playlist = $conn->prepare("INSERT INTO `kursus_gratis2` (id, tutor_id, title, materi1, materi2, materi3, materi4, materi5, materi6, materi7, materi8, materi9, materi10, j1, j2, j3, j4, j5, j6, j7, j8, j9, j10, thumb, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
   $values = array_merge([$id, $tutor_id, $title], $materi, $judul, [$rename, $status]);
   if ($add_playlist->execute($values)) {
      $message[] = 'Kursus telah ditambahkan!';
   } else {
      $message[] = 'Gagal menambahkan kursus. Silakan coba lagi.';
   }
}

?>
<style>
   body {
      background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
      background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
   }

   .footer {
      background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
      background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
   }
</style>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambahkan Materi</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="playlist-form">
      <h1 class="heading">Tambahkan Materi Kursus</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <p>Status kursus <span>*</span></p>
         <select name="status" class="box" required>
            <option value="" selected disabled>-- select status</option>
            <option value="active">active</option>
            <option value="deactive">deactive</option>
         </select>

         <p>Judul Kursus <span>*</span></p>
         <input type="text" name="title" maxlength="100" required placeholder="Tulisakan judul" class="box">

         <?php for ($i = 1; $i <= 10; $i++) { ?>
            <p>Judul <?php echo $i; ?><span>*</span></p>
            <input type="text" name="j<?php echo $i; ?>" maxlength="100" placeholder="Tulisakan judul" class="box">
            <p>Materi <?php echo $i; ?><span>*</span></p>
            <textarea name="m<?php echo $i; ?>" class="box" placeholder="Tuliskan deskripsi" maxlength="1000" cols="30" rows="10"></textarea>
         <?php } ?>

         <p>Masukan foto <span>*</span></p>
         <input type="file" name="image" accept="image/*" required class="box">
         <input type="submit" value="Save" name="submit" class="btn">
      </form>
   </section>

   <?php include '../components/footer.php'; ?>

   <script src="../js/admin_script.js"></script>

</body>

</html>
