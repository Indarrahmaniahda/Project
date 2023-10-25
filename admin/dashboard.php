<link rel="stylesheet" href="css/3.css">
<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

$select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$select_playlists->execute([$tutor_id]);
$total_playlists = $select_playlists->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
$select_likes->execute([$tutor_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();


$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
$select_comments->execute([$tutor_id]);
$total_comments = $select_comments->rowCount();

?>

<style>
   body{
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
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="profile.php" class="btn">Lihat profile</a>
      </div>

      <div class="box">
         <h3><?= $total_contents; ?></h3>
         <p>total konten</p>
         <a href="add_content.php" class="btn">Tambahkan konten</a>
      </div>

      <div class="box">
         <h3><?= $total_playlists; ?></h3>
         <p>total lowongan</p>
         <a href="add_playlist.php" class="btn">Tambahkan Lowongan</a>
      </div>

      <div class="box">
         <h3><?= $total_likes; ?></h3>
         <p>total likes</p>
         <a href="contents.php" class="btn">Lihat konten anda</a>
      </div>

      <div class="box">
         <h3><?= $total_comments; ?></h3>
         <p>total comments</p>
         <a href="comments.php" class="btn">Lihat komen pengguna</a>
      </div>


      <div class="box">
         <h3></h3>
         <p>Daftar User</p>
         <a href="daftar.php" class="btn">Lihat pengguna</a>
         <a href="contact_user.php" class="btn">Lihat contact user</a>
      </div>

     

      <!-- <div class="box">
         <h3>Login sebagai admin</h3>
         <p>login dan register</p>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div> -->

   </div>

</section>










<style>
.footer{
    background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
    background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
}
</style>




<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>