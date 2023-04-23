<?php
require __DIR__ . "/../root/app.php";
session_start();
$ID = $_SESSION["ID"];
$_SESSION["page"] = "lists";
if ($_SESSION["role"] == "admin") {
  // model untuk menampilkan semua member
  require __DIR__ . "/../root/model/lists/getPeopleLists.php";
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

  <title>List</title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>
  <!-- END LEFT SIDEBAR -->

  <!-- CONTENT -->
  <div class="main">
    <!-- header -->
    <div class="main__heading">
      <h2>Lists Member</h2>
    </div>

    <?php include __DIR__ . "/partial/lists/showPeopleList.php"; ?>

  </div>
  <!-- END CONTENT -->
</body>

</html>