<?php
function checkBirthDay($field)
{
  $errMessage = "";
  $fields = trim($field);
  // field wajib diisi
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Birth Day";
  }
  return $errMessage;
}
