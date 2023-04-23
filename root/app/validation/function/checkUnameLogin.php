<?php
function checkUnameLogin($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) { //jika field kosong
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your username";
  } else {
    if (!rowCount("SELECT user_name FROM socmed.user WHERE user_name = '{$fields}'")) { //jika tidak ditemukan username yang dimasukkan di database
      $errMessage = "Username Not Registered";
    }
  }
  return $errMessage;
}
