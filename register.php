<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/' . $rename;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);

   if ($select_user->rowCount() > 0) {
      $message[] = 'email already taken!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm passowrd not matched!';
      } else {
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);

         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);

         if ($verify_user->rowCount() > 0) {
            setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
            header('location:home.php');
         }
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>


   <section class="form-container">

      <form class="register" action="" method="post" enctype="multipart/form-data">
         <h3>Buat Akun</h3>
         <div class="flex">
            <div class="col">
               <p>nama <span>*</span></p>
               <input type="text" name="name" placeholder="eneter your name" maxlength="50" required class="box">
               <p>email <span>*</span></p>
               <input type="email" name="email" placeholder="enter your email" maxlength="255" required class="box">
            </div>
            <div class="col">
               <p>password <span>*</span></p>
               <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
               <p>confirm password <span>*</span></p>
               <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
            </div>
         </div>
         <p>Upload foto mu <span>*</span></p>
         <input type="file" name="image" accept="image/*" required class="box">
         <p class="link">already have an account? <a href="login.php">login now</a></p>
         <input type="submit" name="submit" value="register now" class="btn">
      </form>

   </section>







   <style>
      .form-container {
         margin-left: -100px;

      }

      body {
         background-image: url(https://home.smkpesat.sch.id/wp-content/uploads/2020/12/gedung-sekolah-scaled.jpg);
         position: relative;
         background-size: cover;
      }

     

    
      @media (max-width: 768px) {
         
      .form-container {
         width: 100%;
         /* Lebar maksimum form container */
         display: flex;
         justify-content: center;
         align-items: center;
         margin-left: -30px;
      }

      .register {
         width: 100%;
         max-width: 400px;
         /* Lebar maksimum formulir */
         background: rgba(255, 255, 255, 0.8);
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
         margin-left: 70px;
      }

      .flex {
         display: flex;
         flex-wrap: wrap;
      }

      .col {
         flex: 1;
         /* Setiap kolom mengisi setengah lebar */
         padding: 10px;
      }

      .box {
         width: 100%;
         /* Lebar input 100% untuk mengisi kolom */
         margin-bottom: 10px;
         margin-left: 20px;
      }
         }
  

   </style>










   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>