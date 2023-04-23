<?php
function checkUsername($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your username";
  } else {
    if (rowCount("SELECT user_name FROM socmed.user WHERE user_name = '{$fields}'")) {
      $errMessage = "Username Already taken";
    } elseif (strlen($fields) < 6) {
      $errMessage = "Username at least have 6 character";
    } elseif (!preg_match('/[A-Za-z]+$/', $fields)) {
      $errMessage = "Username must be Alphabet ";
    }
  }
  return $errMessage;
}
