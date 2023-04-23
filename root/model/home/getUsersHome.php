<?php
$getUsersHome = select("SELECT biodata.name,user.user_name,biodata.picture FROM socmed.user, socmed.biodata
WHERE user.user_id = {$ID["user_id"]} AND
biodata.user_id = user.user_id");
