<?php
function checkPassword($field)
{
  $errMessage = "";
  $fields = htmlspecialchars($field);
  if (empty($fields)) {
    $errMessage = "Enter your password";
  } elseif (strlen($fields) < 8) {
    $errMessage = "Password at least 8 character";
  } elseif (!preg_match('#[A-Za-z]+#', $fields)) {
    $errMessage = "Password must have at least 1 character";
  } elseif (!preg_match('#[0-9]+#', $fields)) {
    $errMessage = "Password must have at least 1 number";
  }
  return $errMessage;
}
