<?php
require_once __DIR__ . "/../app.php";
// FUNGSI REGISTER USER KE DB
function insertRegister($method)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.user VALUES ('',:username,:email, :password, :role) ");
    $statement->bindValue(":username", $method["user_name"]);
    $statement->bindValue(":email", $method["user_email"]);
    $statement->bindValue(":password", password_hash($method["user_password"], PASSWORD_DEFAULT));
    $statement->bindValue(":role", $method["role"]);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}

// insert follow
function insertFollowing($params1, $params2)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.follow VALUES ('',:userID,:FollowingID)");
    $statement->bindValue(":userID", $params1);
    $statement->bindValue(":FollowingID", $params2);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}

//insert followers
function insertFollower($params1, $params2)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.followers VALUES ('',:ID,:FollowersID) ");
    $statement->bindValue(":ID", $params1);
    $statement->bindValue(":FollowersID", $params2);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}

// fungsi insert add post
function insertPost($method)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.post VALUES (:id,'',:post) ");
    $statement->bindValue(":id", $method["id"]);
    $statement->bindValue(":post", $method["post"]);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}

function insertBio($method)
{
  global $db;
  if ($method["picture"] === "") {
    $method["picture"] = "default.jpg";
  }
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.biodata VALUES (:userID,'',:pict,:name,:bio,:bday,:bmonth,:byear,:location,:faculty,:graduate)");
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

// insert status friend request
function friendRequest($userID, $friendID, $status)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("INSERT INTO socmed.friend_confirm VALUES ('',:userID,:friendID,:status) ");
    $statement->bindValue(":friendID", $friendID);
    $statement->bindValue(":userID", $userID);
    $statement->bindValue(":status", $status);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}
