<?php
function checkPasswordMatch($field1, $field2)
{
  $errMessage = "";
  $fields = htmlspecialchars($field1);
  $field2 = htmlspecialchars($field2);
  if ($fields !== $field2) {
    $errMessage = "Password Not Match";
  }
  return $errMessage;
}
