<?php
$DB_NAME = "socmed";
$DB_PASSWORD = "";
$DB_UNAME = "root";
$DB_HOST = "localhost";



try {
  $db = new PDO("mysql:host=$DB_HOST;dbname:$DB_NAME", $DB_UNAME, $DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
