<!-- menampilkan POST -->
<?php foreach ($posts as $post) : ?>
  <div class="content">
    <div class="content__ava">
      <img src="../resource/img/member/<?= $post['picture'] ?>" alt="">
    </div>
    <div class="content__body">
      <div class="content__heading">
        <div class="heading-name">
          <a href="profile.php?user_id=<?= $post["user_id"] ?>"><?= $post["name"] ?></a>
        </div>
        <div class="heading-uname">
          @<?= $post["user_name"] ?>
        </div>
        <div class="dot">
          <span>&#183;</span>
        </div>
        <div class="heading-faculty">
          <?= $post["faculty"] ?>
        </div>
        <div class="dot">
          <span>&#183;</span>
        </div>
        <div class="heading-graduate">
          <?= $post["graduation_at"] ?>
        </div>
        <!-- php include __DIR__ . "/set.php" //jika session admin bisa mengedit post 
        ?> -->
      </div>
      <div class="content__desc">
        <?= nl2br($post["post"])  ?>
      </div>
      <!-- <div class="content__footer">
        <div class="footer__comment">
          <a href="#commentPopUp"><img src="../resource/img/page/icon/chat_bubble_outline_black_24dp.svg" alt=""></a>
        </div>
        <div class="comment-count">
          <span>12</span>
        </div>
        <div class="footer_like">
          <a href="#commentPopUp"><img src="../resource/img/page/icon/favorite_border_black_24dp.svg" alt=""></a>
        </div>
        <div class="like-count">
          <span>12</span>
        </div>
      </div> -->
    </div>
  </div>

  <!-- POP UP COMMENT -->

  <!-- POP UP COMMENT END -->

  <!-- POP UP SET : -->
  <div id="setPopUp">
  </div>
  <!-- END POP UP SET : -->
<?php endforeach; ?>