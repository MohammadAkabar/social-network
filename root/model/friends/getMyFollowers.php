<?php
$getFollowers = selectAll("SELECT 
followers.followers_id, 
user.user_name, 
user.user_id, 
biodata.name, 
biodata.picture
FROM 
socmed.followers,socmed.user, 
socmed.biodata 
WHERE 
followers.followers_id = user.user_id AND 
biodata.user_id = followers.followers_id AND 
followers.user_id = {$getID}");
