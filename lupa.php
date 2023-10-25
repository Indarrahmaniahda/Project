<?php
require 'components/connect.php';
require 'vendor/autoload.php'; // Tambahkan ini

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // Cek apakah alamat email valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate token reset kata sandi yang unik
        $token = bin2hex(random_bytes(32));

        // Simpan token ke database dengan informasi timestamp
        $reset_time = time();
        $insert_reset_token = $conn->prepare("INSERT INTO reset_password (email, token, reset_time) VALUES (?, ?, ?)");
        $insert_reset_token->execute([$email, $token, $reset_time]);

        // Kirim email dengan tautan reset kata sandi menggunakan PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan alamat server SMTP Anda (contoh untuk Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'indarxpro@gmail.com'; // Ganti dengan username SMTP Anda
        $mail->Password = 'qbkooufhcgmwlgbu '; // Ganti dengan kata sandi SMTP Anda
        $mail->SMTPSecure="ssl";
        $mail->Port = 465;

        $mail->setFrom('webmaster@example.com', 'Webmaster');
        $mail->addAddress($email);
        $mail->Subject = 'Reset Kata Sandi';
        $mail->Body = "Klik tautan berikut untuk mereset kata sandi Anda: http://localhost/project/reset_password.php?email=$email&token=$token";

        if ($mail->send()) {
            // Email terkirim
            echo "Email reset kata sandi telah dikirim ke alamat email Anda.";
        } else {
            // Gagal mengirim email
            echo "Terjadi kesalahan saat mengirim email reset kata sandi: " . $mail->ErrorInfo;
        }
    } else {
        echo "Alamat email tidak valid.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lupa Akun</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<style>
   .form-container{
    margin-left: -100px;
   }

   body{
      background-image: url(https://home.smkpesat.sch.id/wp-content/uploads/2020/12/gedung-sekolah-scaled.jpg);
      position: relative;
      background-size: cover;
   }

   .login{
   }

   .btn{
      background-color: #00dafc;
   }

   .btn:hover{
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
      <h3>Lupa Akun</h3>
      <p>Masukkan alamat email Anda untuk mereset kata sandi Anda.</p>
      <input type="email" name="email" placeholder="Masukkan alamat email Anda" maxlength="50" required class="box">
      <p class="link"><a href="login.php">Kembali ke halaman login</a></p>
      <input type="submit" name="reset" value="Reset Kata Sandi" class="btn">
   </form>
</section>

<!-- custom js file link -->
<script src="js/script.js"></script>
   
</body>
</html>
