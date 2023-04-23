<?php
function checkGraduate($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Graduate";
  }
  return $errMessage;
}
