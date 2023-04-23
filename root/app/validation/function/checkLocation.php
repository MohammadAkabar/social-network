<?php
function checkLocation($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your Location";
  }
  return $errMessage;
}
