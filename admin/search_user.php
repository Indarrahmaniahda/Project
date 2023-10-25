<link rel="stylesheet" href="css/admin.css">
<?php

include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
   $tutor_id = $_COOKIE['tutor_id'];
} else {
   $tutor_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <!-- Bagian kepala halaman Anda di sini -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">
</head>

<body>

   <?php include '../components/admin_header.php'; ?>


   <section class="teachers">

      <h1 class="heading">Users</h1>

      <form action="search_user.php" method="post" class="search-tutor">
         <input type="text" name="search_tutor" maxlength="100" placeholder="search..." required>
         <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
      </form>

      <div class="box-container">

         <?php
         if (isset($_POST['search_tutor_btn'])) {
            $search_tutor = $_POST['search_tutor'];
            $select_tutors = $conn->prepare("SELECT * FROM `users` WHERE name LIKE ?");
            $select_tutors->execute(["%$search_tutor%"]);
            if ($select_tutors->rowCount() > 0) {
               while ($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)) {

                  // Menghitung total playlists dan total contents
                  $user_id = $fetch_tutor['id'];

                  $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
                  $select_likes->execute([$user_id]);
                  $total_likes = $select_likes->rowCount();

                  $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
                  $select_comments->execute([$user_id]);
                  $total_comments = $select_comments->rowCount();

                  $select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
                  $select_bookmark->execute([$user_id]);
                  $total_bookmarked = $select_bookmark->rowCount();


                  $total_playlists = 0;
                  $total_contents = 0;

                  $cv_rename = ''; // Sesuaikan dengan nilai default yang sesuai

                  // Mengambil informasi CV dari database
                  $select_cv = $conn->prepare("SELECT cv_file_name FROM `cv` WHERE user_id = ?");
                  $select_cv->execute([$user_id]);
                  $cv_data = $select_cv->fetch(PDO::FETCH_ASSOC);

                  // Mendapatkan nama file CV jika ada
                  $cv_rename = !empty($cv_data['cv_file_name']) ? $cv_data['cv_file_name'] : '';
         ?>

                  <div class="box">
                     <div class="tutor">
                        <img src="../uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                        <div>
                           <div class="j">
                              <h3><?= $fetch_tutor['name']; ?></h3>
                           </div>

                           <?php
                           if (isset($fetch_tutor['profession'])) {
                              echo '<span>' . $fetch_tutor['profession'] . '</span>';
                           }
                           ?>
                        </div>
                     </div>

                     <div class="p">
                        <p>Total Likes : <span><?= $total_likes; ?></span></p>
                        <p>Total Comments : <span><?= $total_comments ?></span></p>
                        <p>Total Bookmarked : <span><?= $total_bookmarked  ?></span></p>
                     </div>

                     <style>
                        .profile {
                           margin-left: -30px;
                           margin-top: -30px;
                        }

                        body {
                           background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
                           background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
                        }
                     </style>


                     <section class="profile">
                        <div class="details">
                           <div class="cv">
                              <?php if (!empty($cv_rename)) : ?>
                                 <form action="/project/uploaded_files/<?= $cv_rename; ?>" method="post" target="_blank">
                                    <input type="submit" value="Lihat CV" class="inline-btn">
                                 </form>
                              <?php endif; ?>
                           </div>
                        </div>
                     </section>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">no results found!</p>';
            }
         } else {
            echo '<p class="empty">please search something!</p>';
         }
         ?>

      </div>

   </section>



   <?php include '../components/footer.php'; ?>


   <script src="../js/admin_script.js"></script>

</body>

</html>