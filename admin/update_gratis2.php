<?php
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:Kursus_gratis.php');
}

if (isset($_POST['submit'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);

    $j = array();
    $materi = array();

    for ($i = 1; $i <= 10; $i++) {
        $j_var_name = 'j' . $i;
        $materi_var_name = 'materi' . $i;
        if (isset($_POST[$j_var_name]) && isset($_POST[$materi_var_name])) {
            $j[$i] = filter_var($_POST[$j_var_name], FILTER_SANITIZE_STRING);
            $materi[$i] = filter_var($_POST[$materi_var_name], FILTER_SANITIZE_STRING);
        }
    }

    $update_playlist = $conn->prepare("UPDATE `kursus_gratis2` SET title = ?, j1 = ?, j2 = ?, j3 = ?, j4 = ?, j5 = ?, j6 = ?, j7 = ?, j8 = ?, j9 = ?, j10 = ?, materi1 = ?, materi2 = ?, materi3 = ?, materi4 = ?, materi5 = ?, materi6 = ?, materi7 = ?, materi8 = ?, materi9 = ?, materi10 = ? WHERE id = ?");
    $update_playlist->execute([$title, $j[1], $j[2], $j[3], $j[4], $j[5], $j[6], $j[7], $j[8], $j[9], $j[10], $materi[1], $materi[2], $materi[3], $materi[4], $materi[5], $materi[6], $materi[7], $materi[8], $materi[9], $materi[10], $get_id]);

   
    $old_image = $_POST['old_image'];
    $old_image = filter_var($old_image, FILTER_SANITIZE_STRING);
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);

    if (!empty($image)) {
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id() . '.' . $ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/' . $rename;

        if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
        } else {
            $update_image = $conn->prepare("UPDATE `kursus_gratis2` SET thumb = ? WHERE id = ?");
            $update_image->execute([$rename, $get_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            if ($old_image != '' && $old_image != $rename) {
                unlink('../uploaded_files/' . $old_image);
            }
        }
    }

    $message[] = 'Sudah di update!';
}

if (isset($_POST['delete'])) {
    $delete_id = $_POST['playlist_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $delete_playlist_thumb = $conn->prepare("SELECT * FROM `kursus_gratis2` WHERE id = ? LIMIT 1");
    $delete_playlist_thumb->execute([$delete_id]);
    $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_files/' . $fetch_thumb['thumb']);
    $delete_bookmark = $conn->prepare("DELETE FROM `bookmark4` WHERE playlist_id = ?");
    $delete_bookmark->execute([$delete_id]);
    $delete_playlist = $conn->prepare("DELETE FROM `kursus_gratis2` WHERE id = ?");
    $delete_playlist->execute([$delete_id]);
    header('location:playlists.php');
}
?>


<style>
    body {
        background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
        background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
    }

    .footer {
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
    <title>Update Materi</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../components/admin_header.php'; ?>

    <section class="playlist-form">

        <h1 class="heading">update Konten</h1>

        <?php
        $select_playlist = $conn->prepare("SELECT * FROM `kursus_gratis2` WHERE id = ?");
        $select_playlist->execute([$get_id]);
        if ($select_playlist->rowCount() > 0) {
            while ($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)) {
                $playlist_id = $fetch_playlist['id'];
                $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
                $count_videos->execute([$playlist_id]);
                $total_videos = $count_videos->rowCount();
        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" value="<?= $fetch_playlist['thumb']; ?>">
                    <form action="" method="post" enctype="multipart/form-data">
                       
                        <p>Judul kursus<span>*</span></p>
                        <input type="text" name="title" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['title']; ?>" class="box">

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j1" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j1']; ?>" class="box">
                        <p>Materi 1<span>*</span></p>
                        <textarea type="text" name="materi1" maxlength="10000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi1']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j2" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j2']; ?>" class="box">
                        <p>Materi 2<span>*</span></p>
                        <textarea type="description" name="materi2" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi2']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j3" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j3']; ?>" class="box">
                        <p>Materi 3<span>*</span></p>
                        <textarea type="description" name="materi3" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi3']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j4" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j4']; ?>" class="box">
                        <p>Materi 4<span>*</span></p>
                        <textarea type="description" name="materi4" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi4']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j5" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j5']; ?>" class="box">
                        <p>Materi 5<span>*</span></p>
                        <textarea type="description" name="materi5" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi5']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j6" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j6']; ?>" class="box">
                        <p>Materi 6<span>*</span></p>
                        <textarea type="description" name="materi6" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi6']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j7" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j7']; ?>" class="box">
                        <p>Materi 7<span>*</span></p>
                        <textarea type="description" name="materi7" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi7']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j8" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j8']; ?>" class="box">
                        <p>Materi 8<span>*</span></p>
                        <textarea type="description" name="materi8" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi8']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j9" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j9']; ?>" class="box">
                        <p>Materi 9<span>*</span></p>
                        <textarea type="description" name="materi9" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi9']; ?>" class="box"></textarea>

                        <p>Judul<span>*</span></p>
                        <input type="text" name="j10" maxlength="100" required placeholder="Masukan judul" value="<?= $fetch_playlist['j10']; ?>" class="box">
                        <p>Materi 10<span>*</span></p>
                        <textarea type="description" name="materi10" maxlength="10000000" required placeholder="Masukan Materi " value="<?= $fetch_playlist['materi10']; ?>" class="box"></textarea>


                        <p>Masukan foto<span>*</span></p>
                        <div class="thumb">
                            <span><?= $total_videos; ?></span>
                            <img src="../uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
                        </div>
                        <input type="file" name="image" accept="image/*" class="box">
                        <input type="submit" value="Save" name="submit" class="btn">
                        <div class="flex-btn">
                            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Hapus?');" name="delete">
                            <a href="view_gratis2.php?get_id=<?= $playlist_id; ?>" class="option-btn">Lihat</a>
                        </div>
                    </form>
            <?php
            }
        } else {
            echo '<p class="empty">no playlist added yet!</p>';
        }
            ?>

    </section>
    

    <?php include '../components/footer.php'; ?>

    <script src="../js/admin_script.js"></script>

</body>

</html>