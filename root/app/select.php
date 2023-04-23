<?php

require_once __DIR__ . "/../app.php";

function select($query)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare($query);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $stmt->fetch();
}
function selectAll($query)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare($query);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $stmt->fetchAll();
}
function selectFiltering($query, $param)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare($query);
    $stmt->bindValue(":uname", $param);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $stmt->fetch();
}
function rowCount($query)
{
  global $db;
  try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare($query);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $stmt->rowCount();
}
