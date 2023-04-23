<?php foreach ($getFollowers as $getFollower) : ?>
  <?php $following = rowCount("SELECT followers_id FROM socmed.followers WHERE followers.followers_id = {$ID['user_id']} AND  user_id = {$getFollower["user_id"]}") ? "<input class='follow-btn' type='submit' name='unfollow' value='unfollow'>" : "<input class='follow-btn' type='submit' name='follow' value='follow'>";
  if ($getFollower["user_id"] == $ID['user_id']) {
    $following = "";
  }
  ?>
  <div class="content-friends">
    <div id="followers" class="followersPU">
      <div class="followersPU__ava">
        <img src="../resource/img/member/<?= $getFollower['picture'] ?>" alt="">
      </div>
      <div class="followersPU__content">
        <div class="followersPU__content__username">
          <a href="/socmed/view/profile.php?user_id=<?= $getFollower["user_id"] ?>"><?= $getFollower["name"] ?></a>
        </div>
        <div class="followersPU__content__account">
          <span><?= $getFollower['user_name'] ?></span>
        </div>
      </div>
      <div class="followersPU__end">
        <div class="">
          <form action="" method="POST">
            <input type="hidden" name="connectPeople" value="<?= $getFollower["user_id"] ?>">
            <?= $following ?>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>