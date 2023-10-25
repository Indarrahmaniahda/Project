<?php
include '../components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
 
}

// Inisialisasi variabel $tutor_id dengan nilai default
$tutor_id = 0; // Sesuaikan dengan nilai default yang sesuai

// Mengambil informasi CV dari database
$select_cv = $conn->prepare("SELECT cv_file_name FROM `cv` WHERE user_id = ?");
$select_cv->execute([$user_id]);
$cv_data = $select_cv->fetch(PDO::FETCH_ASSOC);

// Mendapatkan nama file CV jika ada
$cv_rename = !empty($cv_data['cv_file_name']) ? $cv_data['cv_file_name'] : '';

// Ambil informasi profil user
$fetch_profile = []; // Inisialisasi variabel fetch_profile sebagai array kosong

// Anda perlu mengisi $fetch_profile dengan data profil user dari database sesuai dengan kebutuhan

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
<?php include '../components/admin_header.php'; ?>

   <section class="profile">
      <h1 class="heading">Profile User</h1>
      <div class="details">
         <div class="cv">
            <?php if (!empty($cv_rename)) : ?>
              <button> <a href="/project/uploaded_files/<?= $cv_rename; ?>" target="_blank">Lihat CV</a></button>
            <?php endif; ?>
         </div>

       
   </section>

   <style>
     .cv{
      margin-left: 470px;
     }

     .cv button a{
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

 
<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
