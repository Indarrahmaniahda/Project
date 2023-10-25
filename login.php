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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
      header('location:home.php');
   } else {
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
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

      .login {}

      .btn {
         background-color: #00dafc;
      }

      .btn:hover {
         background-color: #4632da;
      }
   </style>


   <section class="form-container">

      <form action="" method="post" enctype="multipart/form-data" class="login">
         <h3>Selamat Datang</h3>
         <p>email<span>*</span></p>
         <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
         <p>password<span>*</span></p>
         <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
         <p class="link">Register with: <a href="login_with_google.php">Google</a></p>
         <p class="link">don't have an account? <a href="register.php">register now</a></p>
         <p class="link"><a href="lupa.php">forgot account ?</a></p>

         <input type="submit" name="submit" value="login now" class="btn">
      </form>

   </section>


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















   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>