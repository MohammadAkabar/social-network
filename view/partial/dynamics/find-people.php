<div class="find-people">
  <div class="find-people__heading">
    <span>Find people</span>
  </div>
  <?php $max = 0; ?>
  <?php foreach ($getFindPeople as $user) : ?>
    <?php
    //jika session idnya sudah ada di followers dan user_id = dinamis dengan foreach array 
    $checking = rowCount("SELECT followers_id FROM socmed.followers WHERE followers.followers_id = {$ID["user_id"]} AND 
   user_id = {$user["user_id"]}") ? true : False;
    ?>
    <?php if (!$checking) : ?>
      <?php if ($max++ < 3) : ?>
        <div class="find-people__body">
          <div class="find-people__body__ava">
            <img src="../resource/img/member/<?= $user['picture'] ?>" alt="">
          </div>
          <div class="find-people__body__content">
            <div class="name">
              <a href="/socmed/view/profile.php?user_id=<?= $user["user_id"] ?>"><?= $user["name"] ?></a>
            </div>
            <div class="uname">
              <span><?= $user["faculty"] ?></span>
              <span>&#183;</span>
              <span><?= $user["graduation_at"] ?></span>
            </div>

          </div>
          <div class="follow-btn">
            <form action="" method="POST">
              <input type="hidden" name="followID" value="<?= $user["user_id"] ?>">
              <input type="submit" name="follow" value="follow">
            </form>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; ?>
  <div class="find-people__footer">
    <a href="connectPeople.php">Show more</a>
  </div>
</div>