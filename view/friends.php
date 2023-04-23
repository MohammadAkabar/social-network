<?php
require __DIR__ . "/../root/app.php";
session_start();
$_SESSION["page"] = "friends";
$ID = $_SESSION["ID"]; //id user yang login
$getID = $_GET["user_id"]; //id user yang dikunjungi
$_SESSION["dynamicsCss"] = $_GET["fol"];



if (isset($_SESSION["role"]) && isset($_SESSION["ID"])) {
  include __DIR__ . "/../root/model/friends/getUser.php"; //
  include __DIR__ . "/../root/model/friends/getMyFollowers.php"; //model digunakan di followers.php
  include __DIR__ . "/../root/model/friends/getMyFollowings.php"; //digunakan di followings.php

  // fitur follow/unfollow function
  if (isset($_POST["follow"])) {
    if (friendRequest($ID["user_id"], $_POST["connectPeople"], 0) && friendRequest($_POST["connectPeople"], $ID["user_id"], 1)) {
      header("Location: friends.php?user_id={$getID}&fol=followers");
    }
    // if (insertFollowing($ID["user_id"], $_POST["connectPeople"]) && insertFollower($_POST["connectPeople"], $ID["user_id"])) {
    // }
  } elseif (isset($_POST["unfollow"])) {
    if (deleteFollowings($ID["user_id"], $_POST["connectPeople"]) > 0 && deleteFollowers($_POST["connectPeople"], $ID["user_id"])) {
      header("Location: friends.php?user_id={$getID}&fol=followings");
    }
  }
  //end function follow/unfollow
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
  <link rel="icon" href="../resource/img/page/icon/app.svg" type="image/x-icon">

  <title>Friends</title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>
  <!-- END LEFT SIDEBAR -->

  <!-- MAIN -->
  <div class="main">
    <!-- header -->
    <div class="main__heading">
      <h2><?= $getUser["name"] ?></h2>
      <span><?= $getUser["user_name"] ?></span>
    </div>

    <!-- FRIEND LIST HEADING -->
    <div class="content-followers">
      <div class="heading">

        <div class="followers  <?= $dynamicsCss = $_SESSION["dynamicsCss"] == "followers" ?  "active" :  ""; ?>">
          <a href="friends.php?user_id=<?= $getID ?>&fol=followers">Followers</a>
        </div>

        <div class="following <?= $dynamicsCss = $_SESSION["dynamicsCss"] == "followings" ?  "active" :  ""; ?>">
          <a href="friends.php?user_id=<?= $getID ?>&fol=followings">Followings</a>
        </div>
      </div>
    </div>
    <!-- END FRIEND LIST HEADING-->

    <!-- FRIEND LIST CONTENT -->
    <?php if ($_GET["fol"] == "followers") : ?>
      <!-- FOLLOWERS -->
      <?php include __DIR__ . "/partial/friends/followers.php" ?>
      <!-- END FOLLOWERS -->
    <?php endif; ?>

    <?php if ($_GET["fol"] == "followings") : ?>
      <!-- FOLLOWING -->
      <?php include __DIR__ . "/partial/friends/followings.php" ?>
      <!-- END FOLLOWING -->
    <?php endif; ?>
    <!-- END FRIEND LIST CONTENT  -->
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
  </div>
  <!-- END RIGHT SIDEBAR -->
</body>

</html>