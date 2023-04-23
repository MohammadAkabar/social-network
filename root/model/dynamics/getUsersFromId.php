<?php
$getUserFromId = select("SELECT *  FROM socmed.biodata, socmed.user
  WHERE biodata.user_id = {$ID['user_id']} AND 
  biodata.user_id = user.user_id ");
