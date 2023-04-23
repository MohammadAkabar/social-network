<?php foreach ($getFollowings as $getFollowing) : ?>
  <?php $following = rowCount("SELECT followers_id FROM socmed.followers WHERE followers.followers_id = {$ID['user_id']} AND 
   user_id = {$getFollowing["user_id"]}") ? "<input class='follow-btn' type='submit' name='unfollow' value='unfollow'>" : "<input class='follow-btn' type='submit' name='follow' value='follow'>";
  if ($getFollowing["user_id"] == $ID['user_id']) {
    $following = "";
  }
  ?>
  <div class="content-friends">
    <div id="followings" class="followingsPU">
      <div class="followingsPU__ava">
        <img src="../resource/img/member/<?= $getFollowing['picture'] ?>" alt="">
      </div>
      <div class="followingsPU__content">
        <div class="followingsPU__content__username">
          <a href="/socmed/view/profile.php?user_id=<?= $getFollowing["user_id"] ?>"><?= $getFollowing["name"] ?></a>
        </div>
        <div class="followingsPU__content__account">
          <span><?= $getFollowing['user_name'] ?></span>
        </div>
      </div>

      <div class="followingsPU__end">
        <div class="">
          <form action="" method="POST">
            <input type="hidden" name="connectPeople" value="<?= $getFollowing["user_id"] ?>">
            <?= $following ?>
          </form>
        </div>
      </div>

    </div>
  </div>
<?php endforeach; ?>