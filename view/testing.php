<?php
require("../root/app.php");
$password = "admin";
echo password_hash($password, PASSWORD_DEFAULT);
