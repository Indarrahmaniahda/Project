<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
}

// Mengambil informasi CV dari database
$select_cv = $conn->prepare("SELECT cv_file_name FROM `cv` WHERE user_id = ?");
$select_cv->execute([$user_id]);
$cv_data = $select_cv->fetch(PDO::FETCH_ASSOC);

// Mendapatkan nama file CV jika ada
$cv_rename = !empty($cv_data['cv_file_name']) ? $cv_data['cv_file_name'] : '';

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="profile">
      <h1 class="heading">Profile User</h1>
      <div class="details">
         <div class="user">
            <img src="uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <p>Student</p>
            <a href="update.php" class="inline-btn">Update Profile</a>
         

        
            <a href="upload.php" class="inline-btn">Tambahkan CV</a> <br> <br>
            <?php if (!empty($cv_rename)) : ?>
               <a href="update._profile.php" class="inline-btn">Update CV</a> <br> <br>
               <a href="uploaded_files/<?= $cv_rename; ?>" target="_blank" ><button class="buton">Lihat CV</button></a>
            <?php endif; ?>
         </div>
         
         <style>
            .buton{
               padding: 17px 17px;
               border-radius: 20px;
               background-color: purple;
               color: white;
               font-size: 17px;
            }
         </style>



         <div class="box-container">
            <div class="box">
               <div class="flex">
                  <i class="fas fa-bookmark"></i>
                  <div>
                     <h3><?= $total_bookmarked; ?></h3>
                     <span>Simpan</span>
                  </div>
               </div>
               <a href="bookmark.php" class="inline-btn">Lihat</a>
            </div>

            <div class="box">
               <div class="flex">
                  <i class="fas fa-heart"></i>
                  <div>
                     <h3><?= $total_likes; ?></h3>
                     <span>Suka</span>
                  </div>
               </div>
               <a href="#" class="inline-btn">Lihat</a>
            </div>

            <div class="box">
               <div class="flex">
                  <i class="fas fa-comment"></i>
                  <div>
                     <h3><?= $total_comments; ?></h3>
                     <span>Video Komen</span>
                  </div>
               </div>
               <a href="#" class="inline-btn">Lihat</a>
            </div>
         </div>
      </div>
   </section>

   <style>
      .cv {
         margin-left: 470px;
      }

      .cv button a {
         padding: 20px 20px;
      }

      .cv button {
         padding: 17px 17px;
         border-radius: 50px;
         margin-left: 30px;
         margin-bottom: 30px;
         margin-top: 30px;
      }
   </style>

   <!-- Footer section starts -->
   <footer class="footer">
      &copy; Copyright @ 2022 by <span>Smk Pesat</span> | All rights reserved!
   </footer>
   <!-- Footer section ends -->

   <!-- Custom JS file link  -->
   <script src="js/script.js"></script>
</body>

</html>