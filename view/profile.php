<?php
require __DIR__ . "/../root/app.php";
session_start();
$ID = $_SESSION["ID"];
$_SESSION["page"] = "profilePeople";
$getID = $_GET["user_id"];
if ($getID == $ID["user_id"]) {  //jika session id sama dengan $getID maka profile yang dituju profile milik sendiri dan button berubah menjadi Edit profile
  include __DIR__ . "/../root/model/profiles/getFollowers.php";
  $_SESSION["page"] = "profile";
  $dynamicsButton = "<a href='#editPopUp'>Edit profile</a>";
} else {
  //jika session login id nya tidak sama dengan $getID maka profiles yang dituju adalah milik org lain 

  //insert dan delete koneksi people follow/unfollow
  if (isset($_POST["follow"])) {
    if (insertFollowing($ID["user_id"], $getID) && insertFollower($getID, $ID["user_id"])) {
      header("Location: profile.php?user_id={$_GET["user_id"]}");
    }
  } elseif (isset($_POST["unfollow"])) {
    if (deleteFollowings($ID["user_id"], $getID) > 0 && deleteFollowers($getID, $ID["user_id"])) {
      header("Location: profile.php?user_id={$_GET["user_id"]}");
    }
  } //end form follow/unfollow


  //data ditimpa jika profile yang dituju bukan milik sendiri
  include __DIR__ . "/../root/model/profiles/getFollowings.php";
  // jika user sudah follow maka btn otomatis berubah menjadi unfollow , begitu sebaliknya
  if ($checking) {
    $dynamicsButton = "<form action='' method='POST'>
                        <input type='hidden' name='connectPeople' value='{$getID}'>
                        <input type='submit' value='unfollow' name='unfollow'>
                      </form>";
  } else {
    $dynamicsButton = "<form action='' method='POST'>
                        <input type='hidden' name='connectPeople' value='{$getID}'>
                        <input type='submit' value='follow' name='follow'>
                      </form>";
  }
}

//insert biodata yang telah di edit
if (isset($_POST["save"])) {
  if (updateBiodata($_POST)) {
    header("Location: profile.php?user_id={$_SESSION["ID"]["user_id"]}");
  } else {
    echo "gagal";
  }
}
// end insert 

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
  <link rel="icon" href="../resource/img/page/icon/app.svg" type="image/x-icon">


  <title><?= $profiles["name"] ?>'s Profile</title>
</head>

<body>
  <!-- LEFT SIDEBAR -->
  <?php include __DIR__ . "/partial/menu/menu.php" ?>

  <!-- END LEFT SIDEBAR -->

  <!-- MAIN -->
  <div class="main">
    <!-- header -->
    <div class="main__heading">
      <h2><?= $profiles["name"] ?></h2>
      <span><?= $postsCount ?></span>
      <span>Post</span>
    </div>

    <!-- PROFILE -->
    <div class="profile">
      <div class="content__profile">
        <div class="cover-bg">
          <div class="profile__ava">
            <img src="../resource/img/member/<?= $profiles['picture'] ?>" alt="">
            <div class="edit-profile">
              <?= $dynamicsButton ?>
            </div>
          </div>
        </div>
        <div class="profile__information">
          <div class="name">
            <span><?= $profiles["name"] ?></span>
          </div>
          <div class="uname">
            <span>@<?= $profiles["user_name"] ?></span>
          </div>

          <?php if (rowCount("SELECT followers_id FROM socmed.followers WHERE followers.followers_id = {$ID['user_id']} AND 
          user_id = {$getID}") || $getID == $ID["user_id"]) : //jika belum follow maka yang tampil hanya sebagian infromasi saja atau profile milik sendiri
          ?>
            <div class="bio-desc">
              <span><?= $profiles["bio"] ?></span>
            </div>
            <div class="bio">
              <div class="address">
                <span><?= $profiles["location"] ?></span>
              </div>
              <div class="faculty">
                <span><?= $profiles["faculty"] ?></span>
              </div>
              <div class="dot">
                <span">&#183;</span>
              </div>
              <div class="graduate">
                <span><?= $profiles["graduation_at"] ?></span>
              </div>
              <div class="birthday">
                <span><?= $profiles["birth_day"] ?> </span>
                <span><?= $profiles["birth_month"] ?></span>
                <span> <?= $profiles["birth_year"] ?></span>
              </div>
            </div>
          <?php endif; ?>
          <div class="follow">
            <div class="following">
              <a href="friends.php?user_id=<?= $profiles["user_id"] ?>&fol=followings">
                <span class="num"><?= $followings ?></span>
                <span class="alpha">following</span>
              </a>
            </div>
            <div class="followers">
              <a href="friends.php?user_id=<?= $profiles["user_id"] ?>&fol=followers">
                <span class="num"><?= $followers ?></span>
                <span class="alpha">followers</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PROFILE-->

    <!-- CONTENT  -->
    <?php if (rowCount("SELECT followers_id FROM socmed.followers WHERE followers.followers_id = {$ID['user_id']} AND 
          user_id = {$getID}") || $getID == $ID["user_id"]) : //jika belum follow maka yang tampil hanya sebagian infromasi saja atau profile milik sendiri
    ?>

      <?php include __DIR__ . "/partial/home/content.php"; ?>

    <?php endif; ?>
    <!-- END CONTENT  -->

    <!-- POP UP EDIT PROFILE-->
    <?php require __DIR__ . "/../root/model/profiles/getBodataUsers.php"; ?>
    <div id="editPopUp" class="editPopUp">
      <div class="edit-profile-form">
        <form action="profile.php?user_id=<?= $_SESSION["ID"]["user_id"] ?>" method="POST">
          <!-- avatar -->
          <div class="biodataBox__ava">
            <label for="pict">
              <div class="ava-box">
                <img class="img-default" src="../resource/img/member/<?= $getBiodataUsers['picture'] ?>" alt="">
                <div class="edit-img">
                  Edit
                </div>
              </div>
            </label>
            <input type="file" name="picture" value="<?= $getBiodataUsers['picture'] ?>" id="pict">
          </div>
          <!-- content -->
          <div class="bioadataBox__content">
            <div class="id">
              <input type="hidden" name="userID" value="<?= $getBiodataUsers['user_id'] ?>">
            </div>
            <div class="name-field">
              <label for="name">Name</label>
              <input type="text" name="name" placeholder="Name" autocomplete="off" value="<?= $getBiodataUsers['name'] ?>">
            </div>
            <div class="bio-field">
              <label for="bio">Bio</label>
              <input type="text" name="bio" autocomplete="off" placeholder="Bio" value="<?= $getBiodataUsers['bio'] ?>">
            </div>
            <div class="location-field">
              <label for="Location">Location</label>
              <input type="text" name="location" placeholder="Location" value="<?= $getBiodataUsers['location'] ?>">
            </div>
            <div class="row-2">
              <div class="graduate-field">
                <label for="graduate">Graduate Year's</label>
                <select name="graduate_at" id="graduate">
                  <option value="<?= $getBiodataUsers['graduation_at'] ?>" default selected> <?= $getBiodataUsers['graduation_at'] ?></option>
                  <?php foreach (range(2000, date("Y")) as $year) : ?>
                    <option style="background-color:#15202b;" value="<?= $year ?>"><?= $year ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="faculty-field">
                <label for="faculty">Faculty</label>
                <select name="faculty" id="faculty">
                  <option value="<?= $getBiodataUsers['faculty'] ?>" default selected><?= $getBiodataUsers['faculty'] ?></option>
                  <option style="background-color:#15202b;" value="Fakultas Teknik">Fakultas Teknik</option>
                  <option style="background-color:#15202b;" value="Fakultas Manajemen dan Bisnis">Fakultas Manajemen dan Bisnis</option>
                  <option style="background-color:#15202b;" value="Fakultas Hukum">Fakultas Hukum</option>
                </select>
              </div>
            </div>
            <div class="row-3">
              <div class="birth-month">
                <label for="month">Month</label>
                <select name="birth_month" id="month">
                  <option value="<?= $getBiodataUsers['birth_month'] ?>" default selected><?= $getBiodataUsers['birth_month'] ?></option>
                  <?php
                  $count = 1;
                  $months = ["January", "february", "March", "April", "Mei", "June", "July", "August", "September", "October", "November", "Desember"]; ?>
                  <?php foreach ($months as $month) : ?>
                    <option style="background-color:#15202b;" value="<?= $count ?>"><?= $month ?></option>
                    <?php $count++; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="birth-day">
                <label for="day">Day</label>
                <select name="birth_day" id="day">
                  <option value="<?= $getBiodataUsers['birth_day'] ?>" default selected><?= $getBiodataUsers['birth_day'] ?></option>
                  <?php for ($day = 1; $day <= 31; $day++) : ?>
                    <option style="background-color:#15202b;" value="<?= $day ?>"><?= $day ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="birth-year">
                <label for="year">Year</label>
                <select name="birth_year" id="year">
                  <option value="<?= $getBiodataUsers['birth_year'] ?>" default selected><?= $getBiodataUsers['birth_year'] ?></option>
                  <?php foreach (range(1990, date("Y")) as $year) : ?>
                    <option style="background-color:#15202b;" value="<?= $year ?>"><?= $year ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="btn-add">
            <input type="submit" value="Save" name="save">
          </div>
        </form>
        <a href="" class="popUpClose-editProfile">&times;</a>
      </div>
    </div>
    <!-- END POP UP EDIT PROFILE-->

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