<?php
require("root/app.php"); //berisi semua fungsi dan konfigurasi yang berada di folder root
session_start();
session_unset(); //semua session di unser atau ditiadakan 

// variabel yang menampung validasi berupa array assosiasi yang nilai nya di set sebagai string kosong
$errUnameRegister = $errPassword = $errPasswordMatch = $errEmail = $errLoginUname = $errLoginPassword =
  [
    "style" => "",
    "err" => "",
    "value" => ""
  ];


require __DIR__ . "/view/partial/register.php"; //validasi form dan insert data ke database dilakukan dihalalman berikut
require __DIR__ . "/view/partial/login.php"; //validasi form login dilakukan di halaman ini



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="resource/css/index.css">
  <link rel="icon" href="resource/img/page/icon/app.svg" type="image/x-icon">
  <title>OLE ALUMNA</title>
</head>

<body>
  <!-- navbar -->
  <section>
    <header>
      <a href="#"><img class="logo" src="resource/img/page/icon/app.svg"></a>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
        <li><a class="login" href="#loginPU">Login</a></li>
      </ul>
    </header>
    <!-- content -->
    <div class="content">

      <div class="img">
        <img src="resource/img/page/banner.png" alt="">
      </div>
      <div class="text">
        <h2><span>Ole Alumna<br></span></h2>
        <p>A Social Network for Alumna University of Ole Olang</p>
        <a href="#popUp">Join Now</a>
      </div>
    </div>
    <!-- end content -->

    <!-- form pop up -->

    <!-- LOGIN -->
    <div id="loginPU" class="popUpboxlogin">
      <div class="popUp-contentlogin">
        <div class="popUp-heading">
          <span>Login</span>
        </div>
        <form action="index.php#loginPU" method="POST">
          <div class="uname-field">
            <label for="uname">username</label>
            <input type="text" name="user_name" <?= $errLoginUname['style'] ?> value="<?= $errLoginUname['value'] ?>">
            <span style="color: red;font: size 15px;"><?= $errLoginUname['err'] ?></span>
          </div>
          <div class="pass-field">
            <label for="pass">Password</label>
            <input type="password" name="user_password" <?= $errLoginPassword['style'] ?> value="<?= $errLoginPassword['value'] ?>">
            <span style="color: red;font: size 15px;"><?= $errLoginPassword['err'] ?></span>
          </div>
          <div class="submit">
            <input type="submit" value="login" name="login">
          </div>

          <a href="" class="popUpClose">&times;</a>
        </form>
      </div>
    </div>
    <!-- END LOGIN -->

    <!-- REGISTER -->
    <div id="popUp" class="popUpBox">
      <div class="popUp-content">
        <div class="popUp-heading">
          <span>Register</span>
        </div>
        <form action="" method="POST">
          <div class="uname-field">
            <label for="uname">Username</label>
            <input type="text" name="user_name" <?= $errUnameRegister["style"] ?> value="<?= $errUnameRegister["value"] ?>">
            <span style="color: red;"><?= $errUnameRegister["err"] ?></span>
          </div>
          <div class="email-field">
            <label for="email">Email</label>
            <input type="text" name="user_email" <?= $errEmail["style"] ?> value="<?= $errEmail['value'] ?>">
            <span style="color: red;"><?= $errEmail["err"] ?></span>
          </div>
          <div class="role-field">
            <label for="role">Choose Role</label>
            <select value="member" name="role" id="role">
              <option value="member">Member</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="pass-field">
            <label for="pass">Password</label>
            <input type="password" name="user_password" <?= $errPassword["style"] ?> value="<?= $errPassword['value'] ?>">
            <span style="color: red;"><?= $errPassword["err"] ?></span>
          </div>
          <div class="confirmPass-field">
            <label for="confirmPass">Pasword Confirmation</label>
            <input type="password" name="passwordConfirm" <?= $errPasswordMatch["style"] ?> value="<?= $errPasswordMatch['value'] ?>">
            <span style="color: red;"><?= $errPasswordMatch["err"] ?></span>
          </div>
          <div class="submit">
            <input type="submit" value="Register" name="register">
          </div>
          <a href="" class="popUpClose">&times;</a>
        </form>
      </div>
      <!-- END REGISTER -->


    </div>
    <!-- end form -->
  </section>
  <!-- end navbar -->

</body>

</html>