<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if (isset($_POST['submit'])) {
   
    $id = unique_id();
    $title = $_POST['title'];
    $link = $_POST['link'];
    $tema = $_POST['tema'];
    $description = $_POST['description'];
    $materi = $_POST['materi'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_folder = '../uploaded_files/' . $rename;

    $add_playlist = $conn->prepare("INSERT INTO `kursus_gratis`(id, tutor_id, title, link, tema, materi, description, thumb, status) VALUES(?,?,?,?,?,?,?,?,?)");
    $add_playlist->execute([$id, $tutor_id, $title, $link, $tema, $materi, $description, $rename, $status]);

    move_uploaded_file($_FILES['image']['tmp_name'], $image_folder);

   $message[] = 'kursus telah dia buat!';  

}

?>

<style>
   body{
      background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
  background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
   }

   .footer{
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
   <title>Tambahkan Kursus</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Tambahkan Kursus</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>Status kursus <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- select status</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>Judul Kursus <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Tulisakan judul" class="box">
    
      <p>Deskripsi Kursus <span>*</span></p>
      <textarea name="description" class="box" required placeholder="Tuliskan deskripsi" maxlength="1000" cols="30" rows="10"></textarea>

      <p>Materi Kursus<span>*</span></p>
      <input type="text" name="tema" maxlength="100" required placeholder="Masukan Materi yang dibahas" class="box">

      <p>Link Kursus<span>*</span></p>
      <input type="text" name="link" maxlength="100" required placeholder="Masukan link" class="box">

      <p>Konten Kursus <span>*</span></p>
      <textarea name="materi" class="box" required placeholder="Tuliskan Konten" maxlength="1000" cols="30" rows="10"></textarea>


      <p>Masukan foto <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" value="Save" name="submit" class="btn">
   </form>

</section>












<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>