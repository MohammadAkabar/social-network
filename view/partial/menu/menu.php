<div class="left-sidebar">
  <img class="left-sidebar__brand" src="../resource/img/page/icon/app.svg" alt="">
  <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "home" ? "active" : "" ?>">
    <img class="left-sidebar__icon" src="../resource/img/page/icon/home_black_24dp.svg" alt="">
    <h2><a href="home.php">Home</a></h2>
  </div>
  <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "profile" ? "active" : "" ?>">
    <img class="left-sidebar__icon" src="../resource/img/page/icon/profile.svg" alt="">
    <h2><a href="profile.php?user_id=<?= $_SESSION["ID"]["user_id"] ?>">Profile</a></h2>
  </div>
  <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "friends" && ($_SESSION["ID"]["user_id"] == $getID)  ?   "active" :  "" ?>">
    <img class="left-sidebar__icon" src="../resource/img/page/icon/friend.svg" alt="">
    <h2><a href="friends.php?user_id=<?= $_SESSION["ID"]["user_id"] ?>&fol=followers">Friends</a></h2>
  </div>
  <?php if ($_SESSION["role"] === "admin") : ?>
    <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "lists" ? "active" : "" ?>">
      <img class="left-sidebar__icon" src="../resource/img/page/icon/format_list_bulleted_black_24dp.svg" alt="">
      <h2><a href="listsPeople.php">List</a></h2>
    </div>
  <?php endif; ?>
  <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "notification" ?  "active" : "" ?>">
    <img class="left-sidebar__icon" src="../resource/img/page/icon/logout_black_24dp.svg" alt="">
    <h2><a href="logout.php">Notification</a></h2>
  </div>
  <div class="left-sidebar__menu <?= $sessionPage = $_SESSION["page"] == "logout" ?  "active" : "" ?>">
    <img class="left-sidebar__icon" src="../resource/img/page/icon/logout_black_24dp.svg" alt="">
    <h2><a href="logout.php">Logout</a></h2>
  </div>
  <!-- SHORTCUT ADD NEW POST  -->
  <div class="left-sidebar__menu-btn">
    <a href="home.php#addNewPost"><img class="" src="../resource/img/page/icon/add_black_24dp.svg" alt=""></a>
  </div>
  <!-- END SHORTCUT -->

</div>