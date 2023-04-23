<?php
session_start();
require __DIR__ . "/../root/app.php";
$ID = $_SESSION["ID"];
$topic = $_GET["topic"];
$_SESSION["page"] = "topics";
//jika sesssion id, role bernilai atau ada isinya
if (isset($_SESSION["role"]) && isset($_SESSION["ID"]) && isset($_GET["topic"])) {
  //jika button follow sudah di submit
  if (isset($_POST["follow"])) {
    //jika berhasil follow
    if (insertFollowing($ID["user_id"], $_POST["followID"]) && insertFollower($_POST["followID"], $ID["user_id"])) {
      echo "oke";
    } else {
      die("failed");
    }
  }
  include __DIR__ . "/../root/model/dynamics/getFindPeople.php";  //query yang dibutuhkan untuk widget find people
  include __DIR__ . "/../root/model/home/getUsersHome.php"; //query yang dibutuhkan untuk informasi user
} else {
  header("Location: home.php");
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

  <title>Topics</title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>
  <!-- END LEFT SIDEBAR -->

  <!-- TOPIC -->
  <div class="main">
    <div class="main__heading">
      <h2>Choose topics</h2>
    </div>
    <?php include __DIR__ . "/../root/model/topics/getTopics.php";
    if (empty($posts)) {
      echo "<div class='nFound'>Topic Not Found</div>";
    }
    include __DIR__ . "/partial/home/content.php"; ?>
  </div>
  <!-- END TOPIC -->

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
  </div>
  <!-- END RIGHT SIDEBAR -->
</body>

</html>