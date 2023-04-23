<?php
function checkPasswordLogin($field, $uname)
{
  $errMessage = "";
  $fields = htmlspecialchars($field);
  if (empty($fields)) {
    $errMessage = "Enter your password";
  } elseif (!password_verify($fields, select("SELECT user_password FROM socmed.user WHERE user_name = '{$uname}'")[0])) {
    $errMessage = "Wrong Password";
  }
  return $errMessage;
}
