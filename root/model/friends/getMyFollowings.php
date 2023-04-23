<?php
$getFollowings = selectAll("SELECT follow.following_id,user.user_id, user.user_name, biodata.name, biodata.picture 
FROM socmed.follow,socmed.user, socmed.biodata 
WHERE follow.following_id = user.user_id AND 
biodata.user_id = follow.following_id AND 
follow.user_id = {$getID}");
