<?php

$getUser = select("SELECT *  FROM socmed.biodata, socmed.user
  WHERE biodata.user_id = {$getID} AND 
  biodata.user_id = user.user_id ");
