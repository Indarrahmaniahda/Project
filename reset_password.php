<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    
    // Proses reset password di sini
    $new_password = $_POST['pass']; // Kata sandi baru yang akan di-hash dengan sha1.
    $hashed_password = sha1($new_password); // Menggunakan sha1 untuk mengenkripsi kata sandi.
    
    // Contoh: Update kata sandi pengguna dalam database
    $update_password_query = $conn->prepare("UPDATE users SET password = :new_password WHERE email = :email");
    $update_password_query->bindParam(':new_password', $hashed_password);
    $update_password_query->bindParam(':email', $email);
    $update_password_query->execute();
    
    // Redirect setelah reset password berhasil
    header('location: home.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv of "X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reset Password</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<style>
   .form-container {
      margin-left: -100px;
   }

   body {
      background-image: url(https://home.smkpesat.sch.id/wp-content/uploads/2020/12/gedung-sekolah-scaled.jpg);
      position: relative;
      background-size: cover;
   }

   .login {
   }

   .btn {
      background-color: #00dafc;
   }

   .btn:hover {
      background-color: #4632da;
   }
</style>

<style>
     
      /* Tambahkan media query untuk lebar layar kurang dari 768px */
      @media (max-width: 768px) {
        
            /* Biarkan form mengisi lebar layar */
             /* Pindahkan CSS Anda ke file eksternal, misalnya style.css */

      body {
         background-image: url(https://home.smkpesat.sch.id/wp-content/uploads/2020/12/gedung-sekolah-scaled.jpg);
         background-size: cover;
         position: relative;
      }

      .form-container {
         margin: 0 auto;
         /* Agar form berada di tengah */
         max-width: 400px;
         /* Lebar maksimum form */
       
         /* Warna latar belakang form */
         padding: 20px;
         border-radius: 10px;
      
      }

      .login {
         text-align: center;
         /* Pusatkan teks dalam form */
      }

      .btn {
         background-color: #00dafc;
      }

      .btn:hover {
         background-color: #4632da;
      }

         }
      
   </style>


<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>Reset Password</h3>
      <!-- <p>Email<span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box"> -->
      <p>Password<span>*</span></p>
      <input type="password" name="pass" placeholder="Enter your new password" maxlength="20" required class="box">
      <input type="submit" name="submit" value="Reset Password" class="btn">
   </form>
</section>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
