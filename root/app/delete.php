<?php
require_once __DIR__ . "/../app.php";

function deleteFollowings($params1, $params2)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("DELETE FROM socmed.follow WHERE follow.user_id = :userID AND follow.following_id = :followingID");
    $statement->bindValue(":userID", $params1);
    $statement->bindValue(":followingID", $params2);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}
function deleteFollowers($params1, $params2)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $db->prepare("DELETE FROM socmed.followers WHERE followers.user_id = :userID AND followers.followers_id = :followersID");
    $statement->bindValue(":userID", $params1);
    $statement->bindValue(":followersID", $params2);
    $statement->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $statement->rowCount();
}
