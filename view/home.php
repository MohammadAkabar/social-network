<?php
session_start();
require __DIR__ . "/../root/app.php";
$ID = $_SESSION["ID"];
$_SESSION["page"] = "home";

//jika sesssion id, role bernilai atau ada isinya
if (isset($_SESSION["role"]) && isset($_SESSION["ID"])) {
  //jika button follow sudah di submit
  if (isset($_POST["follow"])) {
    //jika berhasil follow
    if (insertFollowing($ID["user_id"], $_POST["followID"]) && insertFollower($_POST["followID"], $ID["user_id"])) {
      header("Location: home.php");
    }
  }
  include __DIR__ . "/../root/model/dynamics/getFindPeople.php";  //query yang dibutuhkan untuk widget find people

  include __DIR__ . "/../root/model/home/getUsersHome.php"; //query yang dibutuhkan untuk informasi user

  //jika user menambah post maka di insert ke database
  if (isset($_POST["addPost"])) {
    $addPost = insertPost($_POST, $ID);
    if ($addPost > 0) {
      header("Location: home.php");
    } else {
      header("Location: home.php");
    }
  }
} else {
  header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../resource/css/include/left-sidebar.css">
  <link rel="stylesheet" href="../resource/css/include/main.css">
  <link rel="stylesheet" href="../resource/css/include/right-sidebar.css">
  <link rel="stylesheet" href="../resource/css/include/find-people.css">
  <link rel="stylesheet" href="../resource/css/include/topic.css">
  <link rel="icon" href="../resource/img/page/icon/app.svg" type="image/x-icon">

  <title><?= $getUsersHome["name"] . " (@" . $getUsersHome["user_name"] . ")"; ?></title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>
  <!-- END LEFT SIDEBAR -->

  <!-- MAIN -->
  <div class="main">
    <!-- header -->
    <div class="main__heading">
      <h2>Home</h2>
    </div>

    <!-- ADD NEW POST  -->
    <div class="add-post">
      <form action="" method="POST">
        <div class="add-post__input">
          <img src="../resource/img/member/<?= $getUsersHome['picture'] ?>" alt="">
          <input type="hidden" name="id" value="<?= $ID["user_id"] ?>">
          <textarea name="post" id="addNewPost" rows="6" placeholder="Apa yang anda pikirkan?"></textarea>
        </div>
        <input name="addPost" type="submit" class="add-post__btn" value="Add">
      </form>
    </div>
    <!-- END POST -->

    <!--== content ==-->
    <?php if ($_SESSION["role"] == "admin") {
      include __DIR__ . "/../root/model/home/getPostsAdmin.php";  //semua query berada
      include __DIR__ . "/partial/home/content.php"; //show post
    } else {
      include __DIR__ . "/../root/model/home/getPostsMyFollowings.php"; //semua query berada
      include __DIR__ . "/partial/home/content.php"; //show post
    }
    ?>
    <!-- END CONTENT -->
  </div>
  <!-- END MAIN -->

  <!-- RIGHT SIDEBAR -->
  <div class="right-sidebar">
    <div class="searching">
      <div class="searching-field">
        <img src="../resource/img/page/icon/search.svg" alt="">
        <input type="text" placeholder="search">
      </div>
    </div>
    <!-- WIDGET FOLLOW -->
    <?php include __DIR__ . "/partial/dynamics/find-people.php" ?>
    <!-- END WIDGET  -->

    <!-- TOPIC -->
    <?php include __DIR__ . "/partial/dynamics/allTopics.php" ?>
    <!-- END TOPIC -->
  </div>
  <!-- END RIGHT SIDEBAR -->
</body>

</html>