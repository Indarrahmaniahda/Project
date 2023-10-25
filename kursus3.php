<link rel="stylesheet" href="css/background.css">
<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:home.php');
}

if (isset($_POST['save_list'])) {

    if ($user_id != '') {

        $list_id = $_POST['list_id'];
        $list_id = filter_var($list_id, FILTER_SANITIZE_STRING);

        $select_list = $conn->prepare("SELECT * FROM `bookmark4` WHERE user_id = ? AND playlist_id = ?");
        $select_list->execute([$user_id, $list_id]);

        if ($select_list->rowCount() > 0) {
            $remove_bookmark = $conn->prepare("DELETE FROM `bookmark4` WHERE user_id = ? AND playlist_id = ?");
            $remove_bookmark->execute([$user_id, $list_id]);
            $message[] = 'playlist removed!';
        } else {
            $insert_bookmark = $conn->prepare("INSERT INTO `bookmark4`(user_id, playlist_id) VALUES(?,?)");
            $insert_bookmark->execute([$user_id, $list_id]);
            $message[] = 'playlist saved!';
        }
    } else {
        $message[] = 'please login first!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Detail</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <!-- playlist section starts  -->

    <section class="playlist">

        <h1 class="heading">Materi Kursus</h1>

        <div class="row">

            <?php
            $select_playlist = $conn->prepare("SELECT * FROM `kursus_gratis2` WHERE id = ? and status = ? LIMIT 1");
            $select_playlist->execute([$get_id, 'active']);
            if ($select_playlist->rowCount() > 0) {
                $fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC);

                $playlist_id = $fetch_playlist['id'];

                $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
                $count_videos->execute([$playlist_id]);
                $total_videos = $count_videos->rowCount();

                $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ? LIMIT 1");
                $select_tutor->execute([$fetch_playlist['tutor_id']]);
                $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

                $select_bookmark = $conn->prepare("SELECT * FROM `bookmark4` WHERE user_id = ? AND playlist_id = ?");
                $select_bookmark->execute([$user_id, $playlist_id]);

            ?>

                <div class="col">
                    <form action="" method="post" class="save-list">
                        <input type="hidden" name="list_id" value="<?= $playlist_id; ?>">
                        <?php
                        if ($select_bookmark->rowCount() > 0) {
                        ?>
                            <button type="submit" name="save_list"><i class="fas fa-bookmark"></i><span>saved</span></button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" name="save_list"><i class="far fa-bookmark"></i><span>save</span></button>
                        <?php
                        }
                        ?>


                        <style>
                            .details h3 {
                                font-size: 20px;
                                color: #00f2ff;
                            }

                            .details .title1 {
                                font-size: 17px;
                                color: #00f2ff;
                                text-align: center;
                            }

                            .date {
                                text-align: right;

                            }

                            .col .tutor {
                                margin-top: -10px;
                            }

                            .thumb {}

                            .col .description {
                                font-size: 15px;
                                color: white;
                            }

                            .col .title {}

                            .col .details {
                                font-size: 30px;
                                color: #00f2ff;
                            }

                            @media (max-width: 768px) {}
                        </style>
                    </form>
                    <!-- <div class="thumb">
                        <span><?= $total_videos; ?> videos</span>
                        <img src="uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
                    </div> -->
                </div>
                <br>
                <br>
                <br>

                <div class="col">


                </div>
                <br>

                <div class="col">
                    <div class="details">
                        <div class="tutor">
                            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                            <div>
                                <h3><?= $fetch_tutor['name']; ?></h3>
                                <span><?= $fetch_tutor['profession']; ?></span>
                            </div>
                        </div>



                        <div class="title1">
                            <h3><?= $fetch_playlist['title']; ?></h3>
                        </div>


                        <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
                        <br>
                        <br>

                        <style>
                            .wrapper {
                                display: flex;
                                padding-top: 50px;
                                justify-content: center;
                            }

                            .collapsible {

                                overflow: hidden;
                                font-weight: 500;
                                width: 1000px;
                            }

                            .collapsible input {
                                display: none;
                            }

                            .collapsible input:checked+label:after {
                                transform: rotate(90deg);
                            }

                            .collapsible label {
                                position: relative;
                                font-weight: 600;
                                background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
                                background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
                                box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 1), 0 4px 11px 0 rgba(0, 0, 0, .08);
                                color: white;
                                display: block;
                                margin-bottom: 10px;
                                cursor: pointer;
                                padding: 20px;
                                border-radius: 4px;
                                z-index: 1;
                                text-align: center;


                            }

                            .collapsible label:after {
                                content: "";
                                position: absolute;
                                right: 15px;
                                top: 15px;
                                width: 18px;
                                height: 18px;

                                transition: all 0.3s ease;
                            }

                            .collapsible-text {
                                max-height: 10px;
                                overflow: hidden;
                                border-radius: 4px;
                                /* line-height: 1.4; */
                                position: relative;
                                top: -100%;
                                opacity: 0.5;
                                transition: all 0.3s ease;

                            }

                            .collapsible input:checked~.collapsible-text {
                                max-height: 1000000000000000000000000000000000000000000000000000000000000000000000000000000000px;
                                padding-bottom: 25px;
                                background-image: url(https://smkpesat.sch.id/wp-content/uploads/2020/06/BG-HomePage-High.png);
                                background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 100%);
                                box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 1), 0 4px 11px 0 rgba(0, 0, 0, .08);
                                opacity: 1;
                                top: 0;
                            }

                            .collapsible-text h3 {
                                margin-bottom: 10px;
                                padding: 15px 15px 0;
                                color: black;
                                text-align: center;

                            }

                            .collapsible-text .description {
                                padding-left: 15px;
                                padding-right: 15px;
                                text-align: center;
                                font-size: 17px;

                            }

                            @media (max-width: 768px) {

                                .collapsible {

                                    overflow: hidden;
                                    font-weight: 500;
                                    width: 380px;
                                }

                            }

                            @media (max-width: 1024px) {

                                .collapsible {

                                    overflow: hidden;
                                    font-weight: 500;
                                    
                                }

                            }
                        </style>




                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head">
                                <label for="collapsible-head">
                                    <h3 class="title"><?= $fetch_playlist['j1']; ?></h3>
                                </label>
                                <div class="collapsible-text">

                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi1']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head2">
                                <label for="collapsible-head2">
                                    <h3 class="title"><?= $fetch_playlist['j2']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi2']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head3">
                                <label for="collapsible-head3">
                                    <h3 class="title"><?= $fetch_playlist['j3']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi3']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head4">
                                <label for="collapsible-head4">
                                    <h3 class="title"><?= $fetch_playlist['j4']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi4']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head5">
                                <label for="collapsible-head5">
                                    <h3 class="title"><?= $fetch_playlist['j5']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi5']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head6">
                                <label for="collapsible-head6">
                                    <h3 class="title"><?= $fetch_playlist['j6']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi6']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head7">
                                <label for="collapsible-head7">
                                    <h3 class="title"><?= $fetch_playlist['j7']; ?></h3>
                                </label>
                                <div class="collapsible-text">

                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi7']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head8">
                                <label for="collapsible-head8">
                                    <h3 class="title"><?= $fetch_playlist['j8']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi8']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head9">
                                <label for="collapsible-head9">
                                    <h3 class="title"><?= $fetch_playlist['j9']; ?></h3>
                                </label>
                                <div class="collapsible-text">

                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi9']; ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="wrapper">
                            <div class="collapsible">
                                <input type="checkbox" id="collapsible-head10">
                                <label for="collapsible-head10">
                                    <h3 class="title"><?= $fetch_playlist['j10']; ?></h3>
                                </label>
                                <div class="collapsible-text">


                                    <br>
                                    <div class="description"><?= $fetch_playlist['materi10']; ?></div>
                                </div>
                            </div>

                        </div>





                    </div>
                </div>

            <?php
            } else {
                echo '<p class="empty">belum ada loker!</p>';
            }
            ?>

        </div>

    </section>

    <!-- playlist section ends -->

    <!-- videos container section starts  -->


    <section class="videos-container">

        <h1 class="heading">videos</h1>

        <div class="box-container">

            <?php
            $select_content = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ? AND status = ? ORDER BY date DESC");
            $select_content->execute([$get_id, 'active']);
            if ($select_content->rowCount() > 0) {
                while ($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <a href="watch_video.php?get_id=<?= $fetch_content['id']; ?>" class="box">
                        <i class="fas fa-play"></i>
                        <img src="uploaded_files/<?= $fetch_content['thumb']; ?>" alt="">
                        <h3><?= $fetch_content['title']; ?></h3>


                    </a>
            <?php
                }
            } else {
                echo '<p class="empty">belum membagikan vidio!</p>';
            }
            ?>

        </div>

    </section>

    <!-- videos container section ends -->











    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>