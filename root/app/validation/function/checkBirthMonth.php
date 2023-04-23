<?php
function checkBirthMonth($field)
{
  $errMessage = "";
  $fields = trim($field);
  // field wajib diisi
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Birth Month";
  }
  return $errMessage;
}
