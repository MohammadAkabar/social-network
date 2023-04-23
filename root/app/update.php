<?php 
require_once __DIR__ . "/../app.php";

function updateBiodata($method)
{
  global $db;
  if ($method["picture"] === "") {
    $method["picture"] = "default.jpg";
  }
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("UPDATE socmed.biodata 
    SET user_id = :userID,
    picture = :pict,
    name = :name,
    bio= :bio,
    birth_day= :bday,
    birth_month= :bmonth,
    birth_year = :byear,
    location= :location,
    faculty= :faculty,
    graduation_at= :graduate 
    WHERE user_id = :userID");
    $statement->bindValue(":userID", $method["userID"]);
    $statement->bindValue(":pict", $method["picture"]);
    $statement->bindValue(":name", $method["name"]);
    $statement->bindValue(":bio",  $method["bio"]);
    $statement->bindValue(":bday",  $method["birth_day"]);
    $statement->bindValue(":bmonth",  $method["birth_month"]);
    $statement->bindValue(":byear",  $method["birth_year"]);
    $statement->bindValue(":location",  $method["location"]);
    $statement->bindValue(":faculty",  $method["faculty"]);
    $statement->bindValue(":graduate",  $method["graduate_at"]);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}
