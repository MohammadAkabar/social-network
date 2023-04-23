<?php
// INCLUDE DI HALAMAN index.php
if (isset($_POST["login"])) {           //JIKA TOMBOL LOGIN DI TEKAN
  $uname = $_POST["user_name"];         //mengambil field input
  $password = $_POST["user_password"];

  $errLoginUname["err"] = checkUnameLogin($uname); //nilai variabel array asosiasi err di timpa dengan fungsi validasi yang mereturn string validasi
  $errLoginUname["style"] = checkUnameLogin($uname) != "" ? "style = 'border:1px solid red'" : ""; //ternary operation untuk menimpa array assosisasi style dan jika fungsi validasi mereturn string yang berisi error maka border berwarna merah ditampilkan sebaliknya
  $errLoginUname["value"] = isset($_POST["login"]) ? $_POST["user_name"] : ""; //value yang otomatis terisi di field

  $errLoginPassword["err"] = checkPasswordLogin($password, $uname); //
  $errLoginPassword["style"] = checkPasswordLogin($password, $uname) != "" ? "style = 'border:1px solid red'" : "";
  $errLoginPassword["value"] = isset($_POST["login"]) ? $_POST["user_password"] : "";

  if ($errLoginUname["err"] == ""  && $errLoginPassword["err"] == "") {
    $role = selectFiltering("SELECT role,user_id FROM socmed.user WHERE user_name=:uname", $uname);      //variabel menampung infromasi dari uname yg di inputkan                                  //PENGECEKAN ROLE
    $_SESSION["role"] = $role["role"];                                    //JIKA ROLE ADMIN SET SESSION ROLE SBG ADMIN
    $_SESSION["ID"] = selectFiltering("SELECT user_id FROM socmed.user WHERE user_name=:uname", $uname);;
    header("Location: view/home.php");
  }
}
