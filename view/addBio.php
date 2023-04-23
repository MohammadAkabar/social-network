<?php
session_start();
require __DIR__ . "/../root/app.php";

$errName = $errLocation = $errGraduate = $errFaculty = $errBirthDay = $errBirthMonth = $errBirthYear = ["err" => "", "style" => "", "value" => ""];

$ID = $_SESSION["ID"];
if ((isset($_SESSION["role"]) && isset($_SESSION["ID"]))) { //jika session id dan role bernilai atau ada isinya
  if (isset($_POST["next"])) {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $grad = $_POST["graduate_at"];
    $faculty = $_POST["faculty"];
    $bday = $_POST["birth_day"];
    $bmonth = $_POST["birth_month"];
    $byear = $_POST["birth_year"];

    // validasi nama
    $errName["err"] = checkName($name);
    $errName["style"] = checkName($name) != "" ? "style = 'border:1px solid red'" : "";
    $errName["value"] = isset($_POST["next"]) ? $name : "";

    // validasi Lokasi
    $errLocation["err"] = checkLocation($location);
    $errLocation["style"] = checkLocation($location) != "" ? "style = 'border:1px solid red'" : "";
    $errLocation["value"] = isset($_POST["next"]) ? $location : "";


    // validasi Graduate
    $errGraduate["err"] = checkGraduate($grad);
    $errGraduate["style"] = checkGraduate($grad) != "" ? "style = 'border:1px solid red'" : "";
    $errGraduate["value"] = isset($_POST["next"]) ? $grad : "";


    // validasi faculty
    $errFaculty["err"] = checkFaculty($faculty);
    $errFaculty["style"] = checkFaculty($faculty) != "" ? "style = 'border:1px solid red'" : "";
    $errFaculty["value"] = isset($_POST["next"]) ? $faculty : "";

    // validasi birth
    $errBirthDay["err"] = checkBirthDay($bday);
    $errBirthDay["style"] = checkBirthDay($bday) != "" ? "style = 'border:1px solid red'" : "";
    $errBirthDay["value"] = isset($_POST["next"]) ? $bday : "";

    $errBirthMonth["err"] = checkBirthMonth($bmonth);
    $errBirthMonth["style"] = checkBirthMonth($bmonth) != "" ? "style = 'border:1px solid red'" : "";
    $errBirthMonth["value"] = isset($_POST["next"]) ? $bmonth : "";

    $errBirthYear["err"] = checkBirthYear($byear);
    $errBirthYear["style"] = checkBirthYear($byear) != "" ? "style = 'border:1px solid red'" : "";
    $errBirthYear["value"] = isset($_POST["next"]) ? $byear : "";

    // jika validasi tidak ada error
    if ($errName["err"] == "" && $errLocation["err"] == "" && $errGraduate["err"] == "" && $errFaculty["err"] == "" && $errBirthDay["err"] == "" && $errBirthMonth["err"] == "" && $errBirthYear["err"] == "") {
      if (insertBio($_POST)) {
        header("Location: home.php");
      } else {
        echo "gagal";
      }
    }
  }
} else { //jika session id dan role tidak bernilai maka di redirect ke halaman awal
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../resource/css/addBio.css">
  <link rel="icon" href="../resource/img/page/icon/app.svg" type="image/x-icon">

  <title>Add Bio</title>
</head>

<body>
  <!-- BIODATA  -->
  <div class="biodataBox">
    <div class="biodataBox__heading">
      <h2>Complete Your's Profile</h2>
    </div>
    <form action="" method="POST">
      <!-- avatar -->
      <div class="biodataBox__ava">
        <label for="pict">
          <div class="ava-box">
            <img class="img-default" src="../resource/img/member/default.jpg" alt="">
            <div class="edit-img">
              Edit
            </div>
          </div>
        </label>
        <input type="file" name="picture" value="default.jpg" id="pict">
      </div>
      <!-- content -->
      <div class="bioadataBox__content">
        <div class="id">
          <input type="hidden" name="userID" value="<?= $ID[0] ?>">
        </div>
        <div class="name-field">
          <input type="text" name="name" placeholder="Name" autocomplete="off" <?= $errName['style'] ?> value="<?= $errName['value'] ?>">
          <span style="color: red; font: size 15px;"><?= $errName["err"] ?></span>
        </div>
        <div class="bio-field">
          <input type="text" name="bio" autocomplete="off" placeholder="Bio" value="<?= $val = isset($_POST["next"]) ? $_POST["bio"] : "" ?>">
        </div>
        <div class="location-field">
          <input type="text" name="location" placeholder="Location" <?= $errLocation['style'] ?> value="<?= $errLocation['value'] ?>">
          <span style="color: red; font: size 15px;"><?= $errLocation["err"] ?></span>
        </div>
        <div class="row-2">
          <div class="graduate-field">
            <label for="graduate">Graduate Year's</label>
            <select name="graduate_at" id="graduate" <?= $errGraduate['style'] ?> value="<?= $errGraduate['value'] ?>">
              <option value="" default selected> <?= $errGraduate['value'] ?> </option>
              <?php foreach (range(2000, date("Y")) as $year) : ?>
                <option style="background-color:#15202b;" value="<?= $year ?>"><?= $year ?></option>
              <?php endforeach; ?>
            </select>
            <span style="color: red; font: size 15px;"><?= $errGraduate["err"] ?></span>
          </div>
          <div class="faculty-field">
            <label for="faculty">Faculty</label>
            <select name="faculty" id="faculty" <?= $errFaculty['style'] ?> value="<?= $errFaculty['value'] ?>">
              <option value="" default selected> <?= $errFaculty['value'] ?> </option>
              <option style="background-color:#15202b;" value="Fakultas Teknik">Fakultas Teknik</option>
              <option style="background-color:#15202b;" value="Fakultas Manajemen dan Bisnis">Fakultas Manajemen dan Bisnis</option>
              <option style="background-color:#15202b;" value="Fakultas Hukum">Fakultas Hukum</option>
            </select>
            <span style="color: red; font: size 15px;"><?= $errFaculty["err"] ?></span>
          </div>
        </div>
        <div class="row-3">
          <div class="birth-month">
            <label for="month">Month</label>
            <select name="birth_month" id="month" <?= $errBirthMonth['style'] ?> value="<?= $errBirthMonth['value'] ?>">
              <option value="" default selected> <?= $errBirthMonth['value'] ?> </option>
              <?php
              //menampilkan dropdown month 
              $count = 1;
              $months = ["January", "february", "March", "April", "Mei", "June", "July", "August", "September", "October", "November", "Desember"]; ?>
              <?php foreach ($months as $month) : ?>
                <option style="background-color:#15202b;" value="<?= $count ?>"><?= $month ?></option>
                <?php $count++; ?>
              <?php endforeach; ?>
            </select>
            <span style="color: red; font: size 15px;"><?= $errBirthMonth["err"] ?></span>
          </div>
          <div class="birth-day">
            <label for="day">Day</label>
            <select name="birth_day" id="day" <?= $errBirthDay['style'] ?> value="<?= $errBirthDay['value'] ?>">
              <option value="" default selected> <?= $errBirthDay['value'] ?> </option>
              <?php for ($day = 1; $day <= 31; $day++) : ?>
                <option style="background-color:#15202b;" value="<?= $day ?>"><?= $day ?></option>
              <?php endfor; ?>
            </select>
            <span style="color: red; font: size 15px;"><?= $errBirthDay["err"] ?></span>
          </div>
          <div class="birth-year">
            <label for="year">Year</label>
            <select name="birth_year" id="year" <?= $errBirthYear['style'] ?> value="<?= $errBirthYear['value'] ?>">
              <option value="" default selected> <?= $errBirthYear['value'] ?> </option>
              <?php foreach (range(1990, date("Y")) as $year) : //menampilkan tahun dari 1990 sampai saat ini
              ?>
                <option style="background-color:#15202b;" value="<?= $year ?>"><?= $year ?></option>
              <?php endforeach; ?>
            </select>
            <span style="color: red; font: size 15px;"><?= $errBirthYear["err"] ?></span>
          </div>
        </div>
      </div>
      <div class="btn-add">
        <input type="submit" value="Next" name="next">
      </div>
    </form>

  </div>
  <!-- ENDBIODATA -->
</body>

</html>