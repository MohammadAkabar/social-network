<?php
function checkName($field)
{
  $errMessage = "";
  $fields = trim($field);
  if (empty($fields)) {
    $fields = htmlspecialchars($fields);
    $errMessage = "Enter your username";
  }
  return $errMessage;
}
