<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $profession = $_POST['profession'];
   $profession = filter_var($profession, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
   $select_tutor->execute([$email]);
   
   if($select_tutor->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $profession, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new tutor registered! please login now';
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
   <title>register</title>

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

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Register</h3>
      <div class="flex">
         <div class="col">
            <p>Nama <span>*</span></p>
            <input type="text" name="name" placeholder="masukan nama kamu" maxlength="50" required class="box">
            <p>Profesi kamu <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- Pilih profesi kamu</option>
               <option value="developer">developer</option>
               <option value="desginer">desginer</option>
               <option value="musician">musician</option>
               <option value="biologist">biologist</option>
               <option value="teacher">teacher</option>
               <option value="engineer">engineer</option>
               <option value="lawyer">lawyer</option>
               <option value="accountant">accountant</option>
               <option value="doctor">doctor</option>
               <option value="journalist">journalist</option>
               <option value="photographer">photographer</option>
            </select>
            <p>email <span>*</span></p>
            <input type="email" name="email" placeholder="masukan email kamu" maxlength="255" required class="box">
         </div>
         <div class="col">
            <p>password <span>*</span></p>
            <input type="password" name="pass" placeholder="masukan password kamu" maxlength="20" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm password" maxlength="20" required class="box">
            <p>Pilih foto kamu <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
         </div>
      </div>
      <p class="link">sudah punya akun? <a href="login.php">login sekarang</a></p>
      <input type="submit" name="submit" value="register sekarang" class="btn">
   </form>

</section>

<!-- registe section ends -->




<style>
     

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