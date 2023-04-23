<?php foreach ($getPeopleLists as $getFollower) : ?>
  <div class="content-friends">
    <div id="followers" class="followersPU">
      <div class="followersPU__ava">
        <img src="../resource/img/member/<?= $getFollower['picture'] ?>" alt="">
      </div>
      <div class="followersPU__content">
        <div class="followersPU__content__username">
          <a href="/socmed/view/profile.php?user_id=<?= $getFollower["user_id"] ?>"><?= $getFollower["name"] ?></a>
          <span>@<?= $getFollower['user_name'] ?></span>
        </div>

        <div class="followersPU__content__account">
          <span><?= $getFollower['faculty'] ?></span>
          <span><?= $getFollower['graduation_at'] ?></span>
        </div>
      </div>
      <!-- <div class="followersPU__end">
        <!-- <div class="">
          <form action="" method="POST">
            <input type="hidden" name="connectPeople" value="<= $getFollower["user_id"] ?>">
            <input class='follow-btn' type='submit' name='delete' value='Delete'>
          </form>
        </div> -->
      <!-- </div> -->
    </div>
  </div>
<?php endforeach; ?>