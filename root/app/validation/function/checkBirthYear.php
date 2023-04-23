<?php
function checkBirthYear($field)
{
  $errMessage = "";
  $fields = trim($field);
  // field wajib diisi
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Birth Year";
  }
  return $errMessage;
}
