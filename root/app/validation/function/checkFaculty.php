<?php
function checkFaculty($field)
{
  $errMessage = "";
  $fields = trim($field);
  // field wajib diisi
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Faculty";
  }
  return $errMessage;
}
