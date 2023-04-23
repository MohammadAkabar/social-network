<?php
function checkEmail($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your email";
  } else {
    if (rowCount("SELECT user_email FROM socmed.user WHERE user_email = '{$fields}'")) {
      $errMessage = "Email Already taken";
    } elseif (!filter_var($fields, FILTER_VALIDATE_EMAIL)) {
      $errMessage = "Please enter valid email";
    }
  }
  return $errMessage;
}
