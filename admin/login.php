<link rel="stylesheet" href="css/loginadmin.css">
<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? AND password = ? LIMIT 1");
   $select_tutor->execute([$email, $pass]);
   $row = $select_tutor->fetch(PDO::FETCH_ASSOC);
   
   if($select_tutor->rowCount() > 0){
     setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:dashboard.php');
   }else{
      $message[] = 'email dan password salah!';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<style>
   body{
      background-image: url(https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/108/2023/09/04/02-Sekolah-781806543.jpg);
   }
</style>

<!-- register section starts  -->

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>Selamat datang</h3>
      <p>email <span>*</span></p>
      <input type="email" name="email" placeholder="masukan email kamu" maxlength="20" required class="box">
      <p>password <span>*</span></p>
      <input type="password" name="pass" placeholder="masukan password kamu" maxlength="20" required class="box">
      <p class="link">belum punya akun register sekarang? <a href="register.php">register sekarang</a></p>
      <input type="submit" name="submit" value="login sekarang" class="btn">
   </form>

</section>

<!-- registe section ends -->

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











<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>