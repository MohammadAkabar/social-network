<?php
//include halaman index
if (isset($_POST["register"])) {
  $errUnameRegister["err"] = checkUsername($_POST["user_name"]);
  $errUnameRegister["style"] = checkUsername($_POST["user_name"]) != "" ? "style = 'border:1px solid red'" : "";
  $errUnameRegister["value"] = isset($_POST["register"]) ? $_POST["user_name"] : "";

  // validasi email
  $errEmail["err"] = checkEmail($_POST["user_email"]);
  $errEmail["style"] = checkEmail($_POST["user_email"]) != "" ? "style = 'border:1px solid red'" : "";
  $errEmail["value"] = isset($_POST["register"]) ? $_POST["user_email"] : "";

  $errPassword["err"] = checkPassword($_POST["user_password"]);
  $errPassword["style"] = checkPassword($_POST["user_password"]) != "" ? "style = 'border:1px solid red'" : "";
  $errPassword["value"] = isset($_POST["register"]) ? $_POST["user_password"] : "";

  $errPasswordMatch["err"] = checkPasswordMatch($_POST["user_password"], $_POST["passwordConfirm"]);
  $errPasswordMatch["style"] = checkPasswordMatch($_POST["user_password"], $_POST["passwordConfirm"]) != "" ? "style = 'border:1px solid red'" : "";
  $errPasswordMatch["value"] = isset($_POST["register"]) ? $_POST["passwordConfirm"] : "";


  if (
    $errUnameRegister["err"] == ""  &&
    $errEmail["err"] == "" &&
    $errPassword["err"] == "" &&
    $errPasswordMatch["err"] == "" //jika validasi mereturn nilai string kosong yang artinya validasi selesai
  ) {
    if (insertRegister($_POST) > 0) {
      $userID = select("SELECT user_id FROM socmed.user WHERE user_name = '{$_POST["user_name"]}'");
      $_SESSION["role"] = $_POST["role"]; //session role di set sesuai inputan register
      $_SESSION["ID"] = $userID; //session id di set yang diambil dari database sesuai nama user
      header("Location: view/addBio.php"); //redirect kehalaman add bio
    } else {
      die("gagal");
    }
  }
}
