<?php
require __DIR__ . "/../root/app.php";
session_start();
$_SESSION["page"] = "connectPeople"; //session halaman connect people
$ID = $_SESSION["ID"]; //id user yang login


if (isset($_SESSION["role"]) && isset($_SESSION["ID"])) {
  require __DIR__ . "/../root/model/dynamics/getFindPeople.php";

  // insert follow/followers ke db
  if (isset($_POST["follow"])) {
    if (insertFollowing($ID["user_id"], $_POST["connectPeople"]) && insertFollower($_POST["connectPeople"], $ID["user_id"])) {
      header("Location: connectPeople.php");
    }
  } elseif (isset($_POST["unfollow"])) {
    if (deleteFollowings($ID["user_id"], $_POST["connectPeople"]) > 0 && deleteFollowers($_POST["connectPeople"], $ID["user_id"])) {
      header("Location: connectPeople.php");
    }
  }
  // end insert follow/followers ke db

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
  <link rel="stylesheet" href="../resource/css/include/profile.css">
  <link rel="stylesheet" href="../resource/css/include/friends.css">
  <link rel="stylesheet" href="../resource/css/include/topic.css">
  <link rel="icon" href="../resource/img/page/icon/app.svg" type="image/x-icon">

  <title>Connect People</title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>
  <!-- END LEFT SIDEBAR -->



  <!-- CONTENT -->
  <div class="main">

    <!-- header -->
    <div class="main__heading">
      <h2>Find people</h2>
    </div>
    <!-- END HEADER -->

    <!-- LIST FOLLOWERS -->
    <?php include __DIR__ . "/partial/connectPeople/showPeople.php" ?>
    <!-- END LIST FOLLOWERS -->

  </div>
  <!-- END CONTENT -->



  <!-- RIGHT SIDEBAR -->
  <div class="right-sidebar">
    <div class="searching">
      <div class="searching-field">
        <img src="../resource/img/page/icon/search.svg" alt="">
        <input type="text" placeholder="search">
      </div>
    </div>

    <!-- TOPIC -->
    <?php include __DIR__ . "/partial/dynamics/allTopics.php" ?>
    <!-- END TOPIC -->
  </div>
  <!-- END RIGHT SIDEBAR -->

</body>

</html>